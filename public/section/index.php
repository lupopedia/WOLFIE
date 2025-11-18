<?php
/**
 * WOLFIE MD File Viewer
 * 
 * WHO: Captain WOLFIE (Eric Robin Gerdes)
 * WHAT: Web interface for viewing WOLFIE markdown files with header parsing
 * WHERE: C:\WOLFIE_Ontology\public\WOLFIE\index.php
 * WHEN: 2025-11-03
 * WHY: Display WOLFIE MD files with extracted headers and anchor tags
 * HOW: Parse WOLFIE_BEGIN/END headers, extract in_this_file_we_have, generate anchors
 */

// Set current page for header
$currentPage = 'home';
$pageTitle = 'LUPOPEDIA - WOLFIE MD Viewer';
$pageDescription = 'View WOLFIE markdown files with header parsing';

// Include shared config
require_once __DIR__ . '/config.php';

// Path to MD files directory
$mdFilesPath = WOLFIE_MD_FILES_PATH;

// Check if searching
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchMode = !empty($searchQuery);

// Get file from query string (with security)
$requestedFile = isset($_GET['file']) ? basename($_GET['file']) : 'README.md';

// Security: Only allow .md files, prevent directory traversal
if (!preg_match('/^[a-zA-Z0-9_-]+\.md$/', $requestedFile)) {
    $requestedFile = 'README.md'; // Default to README if invalid
}

$filePath = $mdFilesPath . $requestedFile;
$fileContent = file_exists($filePath) ? file_get_contents($filePath) : '';

/**
 * Simple YAML parser for frontmatter (handles basic arrays and key:value)
 * 
 * @param string $yaml YAML content
 * @return array Parsed data
 */
function parseSimpleYaml($yaml) {
    $data = [];
    $lines = explode("\n", $yaml);
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        
        // Parse key: value or key: [array]
        if (preg_match('/^(\w+):\s*(.+)$/', $line, $matches)) {
            $key = $matches[1];
            $value = trim($matches[2]);
            
            // Check if it's an array [item1, item2, item3]
            if (preg_match('/^\[(.*)\]$/', $value, $arrayMatches)) {
                $items = explode(',', $arrayMatches[1]);
                $data[$key] = array_map(function($item) {
                    return trim($item, ' "\'');
                }, $items);
            } else {
                // Simple value
                $data[$key] = trim($value, '"\'');
            }
        }
    }
    
    return $data;
}

/**
 * Parse WOLFIE headers from markdown file (YAML frontmatter format)
 * 
 * @param string $content Raw markdown content
 * @return array Parsed header data
 */
function parseWolfieHeaders($content) {
    $headers = [
        'agent_username' => 'wolfie', // Default to wolfie if not specified
        'onchannel' => null,
        'tags' => [],
        'collections' => [],
        'in_this_file_we_have' => [],
        'has_wolfie_header' => false,
        'title' => null,
        'date_created' => null,
        'last_modified' => null,
        'status' => null
    ];
    
    // Look for YAML frontmatter (--- at start and end)
    if (preg_match('/^---\s*\n(.*?)\n---\s*$/sm', $content, $matches)) {
        $headers['has_wolfie_header'] = true;
        $yamlContent = $matches[1];
        
        // Parse YAML
        $parsed = parseSimpleYaml($yamlContent);
        
        // Extract known fields
        if (isset($parsed['agent_username'])) {
            $headers['agent_username'] = $parsed['agent_username'];
        }
        
        if (isset($parsed['onchannel'])) {
            $headers['onchannel'] = (int)$parsed['onchannel'];
        }
        
        if (isset($parsed['tags']) && is_array($parsed['tags'])) {
            $headers['tags'] = $parsed['tags'];
        }
        
        if (isset($parsed['collections']) && is_array($parsed['collections'])) {
            $headers['collections'] = $parsed['collections'];
        }
        
        if (isset($parsed['in_this_file_we_have']) && is_array($parsed['in_this_file_we_have'])) {
            $headers['in_this_file_we_have'] = $parsed['in_this_file_we_have'];
        }
        
        if (isset($parsed['title'])) {
            $headers['title'] = $parsed['title'];
        }
        
        if (isset($parsed['date_created'])) {
            $headers['date_created'] = $parsed['date_created'];
        }
        
        if (isset($parsed['last_modified'])) {
            $headers['last_modified'] = $parsed['last_modified'];
        }
        
        if (isset($parsed['status'])) {
            $headers['status'] = $parsed['status'];
        }
    }
    
    return $headers;
}

/**
 * Resolve path to TAGS.md or COLLECTIONS.md with 3-level fallback
 * 
 * @param string $basePath Base path to MD files directory
 * @param int $channel Channel number
 * @param string $agentUsername Agent username (default: wolfie)
 * @param string $type Either 'TAGS' or 'COLLECTIONS'
 * @return string|false Path to file if found, false otherwise
 */
function resolveDefinitionPath($basePath, $channel, $agentUsername, $type) {
    // Level 1: Try agent-specific folder
    $path1 = $basePath . $channel . '_wolfie_' . $agentUsername . DIRECTORY_SEPARATOR . $type . '.md';
    if (file_exists($path1)) {
        return $path1;
    }
    
    // Level 2: Fallback to WOLFIE's base definitions
    $path2 = $basePath . $channel . '_wolfie_wolfie' . DIRECTORY_SEPARATOR . $type . '.md';
    if (file_exists($path2)) {
        return $path2;
    }
    
    // Level 3: Fallback to legacy base folder
    $path3 = $basePath . $channel . '_wolfie' . DIRECTORY_SEPARATOR . $type . '.md';
    if (file_exists($path3)) {
        return $path3;
    }
    
    return false;
}

/**
 * Convert markdown to HTML with anchor tags for sections
 * 
 * @param string $markdown Raw markdown content
 * @param array $sections Array of section names to create anchors for
 * @return string HTML content
 */
function markdownToHtml($markdown, $sections = []) {
    // Remove YAML frontmatter (we'll display it separately)
    $markdown = preg_replace('/^---\s*\n.*?\n---\s*\n/sm', '', $markdown);
    
    // Escape HTML first
    $html = htmlspecialchars($markdown);
    
    // Convert headers and create anchor tags for sections
    // H1 headers
    $html = preg_replace_callback('/^# (.+)$/m', function($matches) use ($sections) {
        $header = $matches[1];
        $anchor = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $header));
        $anchor = trim($anchor, '-');
        return '<h1 id="' . htmlspecialchars($anchor) . '" style="color: #2c3e50; margin-top: 40px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #667eea;">' . $header . '</h1>';
    }, $html);
    
    // H2 headers - create anchors for section names
    $html = preg_replace_callback('/^## (.+)$/m', function($matches) use ($sections) {
        $header = $matches[1];
        $anchor = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $header));
        $anchor = trim($anchor, '-');
        
        // Check if this matches a section from in_this_file_we_have
        $isSection = false;
        foreach ($sections as $section) {
            $sectionAnchor = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $section));
            $sectionAnchor = trim($sectionAnchor, '-');
            if ($anchor === $sectionAnchor || stripos($header, $section) !== false) {
                $isSection = true;
                break;
            }
        }
        
        $style = $isSection 
            ? 'color: #667eea; margin-top: 30px; margin-bottom: 15px; font-weight: bold;'
            : 'color: #2c3e50; margin-top: 30px; margin-bottom: 15px;';
        
        return '<h2 id="' . htmlspecialchars($anchor) . '" style="' . $style . '">' . $header . '</h2>';
    }, $html);
    
    // H3 headers
    $html = preg_replace('/^### (.+)$/m', '<h3 style="color: #667eea; margin-top: 25px; margin-bottom: 12px;">$1</h3>', $html);
    
    // Convert bold
    $html = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $html);
    
    // Convert inline code
    $html = preg_replace('/`([^`]+)`/', '<code style="background: #f8f9fa; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-size: 0.9em; color: #e83e8c;">$1</code>', $html);
    
    // Convert code blocks
    $html = preg_replace('/```(\w+)?\n(.*?)```/s', '<pre style="background: #f8f9fa; padding: 15px; border-radius: 6px; overflow-x: auto; margin: 20px 0;"><code>$2</code></pre>', $html);
    
    // Convert list items
    $html = preg_replace('/^- (.+)$/m', '<li style="margin-bottom: 8px;">$1</li>', $html);
    $html = preg_replace('/(<li[^>]*>.*<\/li>\n?)+/s', '<ul style="margin: 15px 0; padding-left: 25px; line-height: 1.8;">$0</ul>', $html);
    
    // Convert horizontal rules
    $html = preg_replace('/^---$/m', '<hr style="border: none; border-top: 1px solid #e9ecef; margin: 40px 0;">', $html);
    
    // Convert paragraphs (double newlines)
    $html = preg_replace('/\n\n+/', '</p><p style="margin: 15px 0; line-height: 1.6;">', $html);
    $html = '<p style="margin: 15px 0; line-height: 1.6;">' . $html . '</p>';
    
    // Clean up empty paragraphs
    $html = preg_replace('/<p[^>]*>\s*<\/p>/', '', $html);
    
    return $html;
}

/**
 * Search across all MD files
 * 
 * @param string $searchPath Path to MD files directory
 * @param string $query Search query
 * @return array Search results with filename, line number, and context
 */
function searchMdFiles($searchPath, $query) {
    $results = [];
    
    if (!is_dir($searchPath) || empty($query)) {
        return $results;
    }
    
    $files = scandir($searchPath);
    
    foreach ($files as $file) {
        if (!preg_match('/\.md$/', $file)) {
            continue; // Skip non-MD files
        }
        
        $filePath = $searchPath . $file;
        $content = file_get_contents($filePath);
        $lines = explode("\n", $content);
        
        foreach ($lines as $lineNum => $line) {
            // Case-insensitive search
            if (stripos($line, $query) !== false) {
                // Get context (line before and after)
                $contextBefore = $lineNum > 0 ? $lines[$lineNum - 1] : '';
                $contextAfter = isset($lines[$lineNum + 1]) ? $lines[$lineNum + 1] : '';
                
                // Try to determine section/header
                $section = '';
                for ($i = $lineNum - 1; $i >= 0; $i--) {
                    if (preg_match('/^##?\s+(.+)$/', $lines[$i], $m)) {
                        $section = $m[1];
                        break;
                    }
                }
                
                $results[] = [
                    'file' => $file,
                    'line_num' => $lineNum + 1,
                    'line' => $line,
                    'context_before' => $contextBefore,
                    'context_after' => $contextAfter,
                    'section' => $section
                ];
            }
        }
    }
    
    return $results;
}

/**
 * Highlight search terms in text
 * 
 * @param string $text Text to highlight in
 * @param string $query Search query
 * @return string HTML with highlighted terms
 */
function highlightSearchTerm($text, $query) {
    $escaped = htmlspecialchars($text);
    $escapedQuery = htmlspecialchars($query);
    
    // Case-insensitive replace with highlight
    $highlighted = preg_replace(
        '/(' . preg_quote($escapedQuery, '/') . ')/i',
        '<mark style="background: #fff3cd; padding: 2px 4px; border-radius: 3px;">$1</mark>',
        $escaped
    );
    
    return $highlighted;
}

// Perform search if in search mode
$searchResults = [];
if ($searchMode) {
    $searchResults = searchMdFiles($mdFilesPath, $searchQuery);
}

// Parse headers if file exists
$wolfieHeaders = [];
if ($fileContent && !$searchMode) {
    $wolfieHeaders = parseWolfieHeaders($fileContent);
}

?>
<style>
    .wolfie-viewer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    .wolfie-header-panel {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }
    
    .wolfie-header-panel h2 {
        margin: 0 0 20px 0;
        font-size: 2rem;
    }
    
    .wolfie-header-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .wolfie-meta-item {
        background: rgba(255,255,255,0.1);
        padding: 12px;
        border-radius: 8px;
    }
    
    .wolfie-meta-item strong {
        display: block;
        margin-bottom: 5px;
        opacity: 0.9;
    }
    
    .wolfie-meta-item .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }
    
    .wolfie-meta-item .tag {
        background: rgba(255,255,255,0.2);
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.85rem;
        transition: all 0.2s;
    }
    
    .wolfie-meta-item .tag:hover {
        background: rgba(255,255,255,0.4);
        transform: translateY(-2px);
    }
    
    .wolfie-content-panel {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        line-height: 1.8;
    }
    
    .wolfie-table-of-contents {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        border-left: 4px solid #667eea;
    }
    
    .wolfie-table-of-contents h3 {
        margin: 0 0 15px 0;
        color: #667eea;
    }
    
    .wolfie-table-of-contents ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .wolfie-table-of-contents li {
        margin: 8px 0;
    }
    
    .wolfie-table-of-contents a {
        color: #495057;
        text-decoration: none;
        padding: 5px 10px;
        display: block;
        border-radius: 4px;
        transition: background 0.2s;
    }
    
    .wolfie-table-of-contents a:hover {
        background: #e9ecef;
        color: #667eea;
    }
    
    .file-not-found {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    
    .file-selector {
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    
    .file-selector select {
        padding: 10px 15px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        font-size: 1rem;
        width: 100%;
        max-width: 400px;
    }
    
    .search-box {
        margin-bottom: 20px;
        padding: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .search-box input[type="text"] {
        padding: 12px 20px;
        border: none;
        border-radius: 25px;
        font-size: 1rem;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .search-box button {
        padding: 12px 30px;
        background: white;
        color: #667eea;
        border: none;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 600;
        margin-left: 10px;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    
    .search-box button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .search-results {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .search-result-item {
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid #667eea;
        background: #f8f9fa;
        border-radius: 8px;
        transition: background 0.2s;
    }
    
    .search-result-item:hover {
        background: #e9ecef;
    }
    
    .search-result-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .search-result-file {
        font-weight: 600;
        color: #667eea;
        text-decoration: none;
    }
    
    .search-result-file:hover {
        text-decoration: underline;
    }
    
    .search-result-location {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .search-result-content {
        font-family: monospace;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-top: 10px;
    }
    
    .search-result-context {
        color: #6c757d;
        opacity: 0.7;
    }
    
    .search-result-match {
        color: #2c3e50;
        font-weight: 500;
    }
    
    .search-stats {
        padding: 15px;
        background: #e7f3ff;
        border-left: 4px solid #0056b3;
        border-radius: 6px;
        margin-bottom: 20px;
    }
</style>

<div class="wolfie-viewer-container">
    <!-- Search Box -->
    <div class="search-box">
        <form method="GET" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <input 
                type="text" 
                name="search" 
                placeholder="🔍 Search across all WOLFIE MD files..." 
                value="<?php echo htmlspecialchars($searchQuery); ?>"
                style="flex: 1; min-width: 250px;">
            <button type="submit">Search</button>
            <?php if ($searchMode): ?>
                <a href="index.php" style="color: white; text-decoration: none; padding: 12px 20px; background: rgba(255,255,255,0.2); border-radius: 25px;">Clear</a>
            <?php endif; ?>
        </form>
    </div>
    
    <?php if ($searchMode): ?>
        <!-- Search Results -->
        <div class="search-results">
            <h2 style="margin-top: 0; color: #2c3e50;">Search Results</h2>
            
            <?php if (!empty($searchResults)): ?>
                <div class="search-stats">
                    Found <strong><?php echo count($searchResults); ?></strong> match<?php echo count($searchResults) !== 1 ? 'es' : ''; ?> 
                    for "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>"
                </div>
                
                <?php foreach ($searchResults as $result): ?>
                    <?php
                    // Create anchor for the section
                    $anchor = '';
                    if (!empty($result['section'])) {
                        $anchor = '#' . strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $result['section']));
                        $anchor = trim($anchor, '-');
                    }
                    ?>
                    <div class="search-result-item">
                        <div class="search-result-header">
                            <a href="?file=<?php echo urlencode($result['file']) . $anchor; ?>" class="search-result-file">
                                📄 <?php echo htmlspecialchars($result['file']); ?>
                            </a>
                            <span class="search-result-location">
                                Line <?php echo $result['line_num']; ?>
                                <?php if (!empty($result['section'])): ?>
                                    · Section: <?php echo htmlspecialchars($result['section']); ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <div class="search-result-content">
                            <?php if (!empty($result['context_before'])): ?>
                                <div class="search-result-context">
                                    <?php echo htmlspecialchars(substr($result['context_before'], 0, 100)); ?>
                                    <?php echo strlen($result['context_before']) > 100 ? '...' : ''; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="search-result-match">
                                → <?php echo highlightSearchTerm($result['line'], $searchQuery); ?>
                            </div>
                            
                            <?php if (!empty($result['context_after'])): ?>
                                <div class="search-result-context">
                                    <?php echo htmlspecialchars(substr($result['context_after'], 0, 100)); ?>
                                    <?php echo strlen($result['context_after']) > 100 ? '...' : ''; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 40px; color: #6c757d;">
                    <p>No results found for "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>"</p>
                    <p style="font-size: 0.9rem;">Try a different search term or <a href="index.php" style="color: #667eea;">browse files</a></p>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
    
    <!-- File Selector -->
    <div class="file-selector">
        <form method="GET" style="display: inline;">
            <label for="file-select" style="font-weight: 600; margin-right: 10px;">Select File:</label>
            <select name="file" id="file-select" onchange="this.form.submit()">
                <?php
                // Get list of MD files
                $mdFiles = [];
                if (is_dir($mdFilesPath)) {
                    $files = scandir($mdFilesPath);
                    foreach ($files as $file) {
                        if (preg_match('/\.md$/', $file)) {
                            $mdFiles[] = $file;
                        }
                    }
                    sort($mdFiles);
                }
                
                foreach ($mdFiles as $file) {
                    $selected = ($file === $requestedFile) ? ' selected' : '';
                    echo '<option value="' . htmlspecialchars($file) . '"' . $selected . '>' . htmlspecialchars($file) . '</option>';
                }
                ?>
            </select>
        </form>
    </div>
    
    <?php if ($fileContent): ?>
        <!-- WOLFIE Header Panel -->
        <?php if ($wolfieHeaders['has_wolfie_header']): ?>
            <div class="wolfie-header-panel">
                <h2>📋 YAML Frontmatter (WOLFIE Headers)</h2>
                <div class="wolfie-header-meta">
                    <?php if ($wolfieHeaders['date_created']): ?>
                        <div class="wolfie-meta-item">
                            <strong>Created</strong>
                            <span><?php echo htmlspecialchars($wolfieHeaders['date_created']); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($wolfieHeaders['last_modified']): ?>
                        <div class="wolfie-meta-item">
                            <strong>Modified</strong>
                            <span><?php echo htmlspecialchars($wolfieHeaders['last_modified']); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($wolfieHeaders['status']): ?>
                        <div class="wolfie-meta-item">
                            <strong>Status</strong>
                            <span style="text-transform: capitalize;"><?php echo htmlspecialchars($wolfieHeaders['status']); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($wolfieHeaders['agent_username']): ?>
                        <div class="wolfie-meta-item">
                            <strong>Agent</strong>
                            <span style="text-transform: capitalize;"><?php echo htmlspecialchars($wolfieHeaders['agent_username']); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($wolfieHeaders['onchannel']): ?>
                        <div class="wolfie-meta-item">
                            <strong>Channel</strong>
                            <span>Channel <?php echo htmlspecialchars($wolfieHeaders['onchannel']); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($wolfieHeaders['tags'])): ?>
                        <div class="wolfie-meta-item">
                            <strong>TAGS</strong>
                            <div class="tags">
                                <?php foreach ($wolfieHeaders['tags'] as $tag): ?>
                                    <a href="definitions.php?type=tags&channel=<?php echo $wolfieHeaders['onchannel'] ?? 1; ?>&agent=<?php echo urlencode($wolfieHeaders['agent_username'] ?? 'wolfie'); ?>&name=<?php echo urlencode($tag); ?>" 
                                       class="tag" 
                                       style="cursor: pointer; text-decoration: none; color: inherit;"
                                       title="View definition for <?php echo htmlspecialchars($tag); ?> (Agent: <?php echo htmlspecialchars($wolfieHeaders['agent_username'] ?? 'wolfie'); ?>)">
                                        <?php echo htmlspecialchars($tag); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($wolfieHeaders['collections'])): ?>
                        <div class="wolfie-meta-item">
                            <strong>COLLECTIONS</strong>
                            <div class="tags">
                                <?php foreach ($wolfieHeaders['collections'] as $collection): ?>
                                    <a href="definitions.php?type=collections&channel=<?php echo $wolfieHeaders['onchannel'] ?? 1; ?>&agent=<?php echo urlencode($wolfieHeaders['agent_username'] ?? 'wolfie'); ?>&name=<?php echo urlencode($collection); ?>" 
                                       class="tag" 
                                       style="cursor: pointer; text-decoration: none; color: inherit;"
                                       title="View definition for <?php echo htmlspecialchars($collection); ?> (Agent: <?php echo htmlspecialchars($wolfieHeaders['agent_username'] ?? 'wolfie'); ?>)">
                                        <?php echo htmlspecialchars($collection); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Table of Contents -->
        <?php if (!empty($wolfieHeaders['in_this_file_we_have'])): ?>
            <div class="wolfie-table-of-contents">
                <h3>📑 Table of Contents</h3>
                <ul>
                    <?php foreach ($wolfieHeaders['in_this_file_we_have'] as $section): ?>
                        <?php
                        $anchor = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $section));
                        $anchor = trim($anchor, '-');
                        ?>
                        <li><a href="#<?php echo htmlspecialchars($anchor); ?>"><?php echo htmlspecialchars($section); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <!-- Content Panel -->
        <div class="wolfie-content-panel">
            <?php 
            echo markdownToHtml($fileContent, $wolfieHeaders['in_this_file_we_have'] ?? []);
            ?>
        </div>
    <?php else: ?>
        <div class="file-not-found">
            <h2>File Not Found</h2>
            <p>The requested file "<?php echo htmlspecialchars($requestedFile); ?>" could not be found.</p>
            <a href="?file=README.md" style="color: #667eea; text-decoration: none; font-weight: 600;">← Try README.md</a>
        </div>
    <?php endif; ?>
    
    <?php endif; // End search mode check ?>
</div>

