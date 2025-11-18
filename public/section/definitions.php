<?php
/**
 * WOLFIE Definitions Viewer
 * 
 * WHO: Captain WOLFIE (Eric Robin Gerdes)
 * WHAT: View definitions from TAGS.md and COLLECTIONS.md files
 * WHERE: C:\WOLFIE_Ontology\public\WOLFIE\definitions.php
 * WHEN: 2025-11-03
 * WHY: Display tag and collection definitions from source of truth files
 * HOW: Parse markdown files and extract content under specific headers
 */

// Set current page
$currentPage = 'home';
$pageTitle = 'LUPOPEDIA - WOLFIE Definitions';
$pageDescription = 'View TAGS and COLLECTIONS definitions';

// Include shared config
require_once __DIR__ . '/config.php';

// Path to MD files directory
$mdFilesPath = WOLFIE_MD_FILES_PATH;

// Get parameters from query string
$channel = isset($_GET['channel']) ? (int)$_GET['channel'] : 1;
$type = isset($_GET['type']) ? strtolower($_GET['type']) : 'collections'; // 'tags' or 'collections'
$name = isset($_GET['name']) ? strtoupper(trim($_GET['name'])) : '';
$agentUsername = isset($_GET['agent']) ? strtolower(trim($_GET['agent'])) : 'wolfie';

// Security: Only allow 'tags' or 'collections'
if (!in_array($type, ['tags', 'collections'])) {
    $type = 'collections';
}

// Security: Only allow alphanumeric agent usernames
if (!preg_match('/^[a-z0-9_]+$/', $agentUsername)) {
    $agentUsername = 'wolfie';
}

/**
 * Resolve path to TAGS.md or COLLECTIONS.md with 3-level fallback
 * 
 * @param string $basePath Base path to MD files directory
 * @param int $channel Channel number
 * @param string $agentUsername Agent username (default: wolfie)
 * @param string $type Either 'TAGS' or 'COLLECTIONS'
 * @return array ['path' => string|false, 'source' => string] Path and source level
 */
function resolveDefinitionPath($basePath, $channel, $agentUsername, $type) {
    $fileName = $type . '.md';
    
    // Level 1: Try agent-specific folder
    $path1 = $basePath . $channel . '_wolfie_' . $agentUsername . DIRECTORY_SEPARATOR . $fileName;
    if (file_exists($path1)) {
        return ['path' => $path1, 'source' => 'agent-specific (' . $agentUsername . ')'];
    }
    
    // Level 2: Fallback to WOLFIE's base definitions
    $path2 = $basePath . $channel . '_wolfie_wolfie' . DIRECTORY_SEPARATOR . $fileName;
    if (file_exists($path2)) {
        return ['path' => $path2, 'source' => 'wolfie base'];
    }
    
    // Level 3: Fallback to legacy base folder
    $path3 = $basePath . $channel . '_wolfie' . DIRECTORY_SEPARATOR . $fileName;
    if (file_exists($path3)) {
        return ['path' => $path3, 'source' => 'legacy base'];
    }
    
    return ['path' => false, 'source' => 'not found'];
}

// Resolve file path with 3-level fallback
$fileName = $type === 'tags' ? 'TAGS' : 'COLLECTIONS';
$pathInfo = resolveDefinitionPath($mdFilesPath, $channel, $agentUsername, $fileName);
$filePath = $pathInfo['path'];
$definitionSource = $pathInfo['source'];

/**
 * Parse definitions file and extract all sections
 * 
 * @param string $filePath Path to TAGS.md or COLLECTIONS.md
 * @return array Array of sections with name and content
 */
function parseDefinitions($filePath) {
    if (!file_exists($filePath)) {
        return [];
    }
    
    $content = file_get_contents($filePath);
    $sections = [];
    
    // Split by H2 headers (## TAGNAME or ##TAGNAME - with or without space)
    $parts = preg_split('/^##\s*([A-Z_]+)\s*$/m', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
    
    // First part is before any sections (skip it)
    array_shift($parts);
    
    // Process pairs of (name, content)
    for ($i = 0; $i < count($parts); $i += 2) {
        if (isset($parts[$i]) && isset($parts[$i + 1])) {
            $sectionName = trim($parts[$i]);
            $sectionContent = trim($parts[$i + 1]);
            
            $sections[$sectionName] = $sectionContent;
        }
    }
    
    return $sections;
}

/**
 * Convert markdown to HTML (simple version)
 * 
 * @param string $markdown Raw markdown content
 * @return string HTML content
 */
function simpleMarkdownToHtml($markdown) {
    // Escape HTML first
    $html = htmlspecialchars($markdown);
    
    // Convert bold
    $html = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $html);
    
    // Convert inline code
    $html = preg_replace('/`([^`]+)`/', '<code style="background: #f8f9fa; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-size: 0.9em; color: #e83e8c;">$1</code>', $html);
    
    // Convert list items
    $html = preg_replace('/^- (.+)$/m', '<li>$1</li>', $html);
    $html = preg_replace('/(<li>.*<\/li>\n?)+/s', '<ul style="margin: 10px 0; padding-left: 25px; line-height: 1.8;">$0</ul>', $html);
    
    // Convert headers
    $html = preg_replace('/^### (.+)$/m', '<h4 style="color: #667eea; margin-top: 20px; margin-bottom: 10px;">$1</h4>', $html);
    
    // Convert paragraphs
    $html = preg_replace('/\n\n+/', '</p><p style="margin: 15px 0; line-height: 1.6;">', $html);
    $html = '<p style="margin: 15px 0; line-height: 1.6;">' . $html . '</p>';
    
    // Clean up empty paragraphs
    $html = preg_replace('/<p[^>]*>\s*<\/p>/', '', $html);
    
    return $html;
}

// Parse the definitions file
$definitions = parseDefinitions($filePath);

// Get list of available channels from config
$availableChannels = getWolfieChannels();

?>
<style>
    .definitions-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    .definitions-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }
    
    .definitions-header h1 {
        margin: 0 0 10px 0;
        font-size: 2.5rem;
    }
    
    .definitions-header .subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
    }
    
    .definitions-nav {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    
    .definitions-nav a,
    .definitions-nav button {
        padding: 12px 24px;
        background: white;
        color: #667eea;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 600;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.2s;
        border: 2px solid transparent;
        cursor: pointer;
        font-size: 1rem;
    }
    
    .definitions-nav a:hover,
    .definitions-nav button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .definitions-nav a.active,
    .definitions-nav button.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    
    .definitions-sidebar {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }
    
    .definitions-sidebar h3 {
        margin: 0 0 15px 0;
        color: #2c3e50;
    }
    
    .definitions-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
    }
    
    .definitions-list a {
        padding: 12px;
        background: #f8f9fa;
        color: #495057;
        text-decoration: none;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        transition: all 0.2s;
        border: 2px solid transparent;
    }
    
    .definitions-list a:hover {
        background: #e9ecef;
        color: #667eea;
    }
    
    .definitions-list a.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    
    .definition-content {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        line-height: 1.8;
    }
    
    .definition-content h2 {
        color: #667eea;
        margin-top: 0;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
    }
    
    .channel-selector {
        display: inline-block;
        padding: 8px 15px;
        background: rgba(255,255,255,0.2);
        border-radius: 20px;
        margin-top: 10px;
    }
    
    .channel-selector select {
        background: transparent;
        color: white;
        border: none;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        padding: 5px;
    }
    
    .channel-selector select option {
        background: #667eea;
        color: white;
    }
    
    .no-content {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    
    .back-button {
        display: inline-block;
        padding: 12px 24px;
        background: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 600;
        margin-top: 20px;
    }
    
    .back-button:hover {
        background: #5a6268;
    }
</style>

<div class="definitions-container">
    <!-- Header -->
    <div class="definitions-header">
        <h1><?php echo strtoupper($type); ?> Definitions</h1>
        <p class="subtitle">
            Agent: <strong style="text-transform: capitalize;"><?php echo htmlspecialchars($agentUsername); ?></strong> | 
            Channel: <strong><?php echo $channel; ?></strong>
            <?php if ($filePath): ?>
                | Source: <strong><?php echo htmlspecialchars($definitionSource); ?></strong>
            <?php endif; ?>
        </p>
        
        <!-- Agent & Channel Selectors -->
        <div style="margin-top: 15px; display: flex; gap: 15px; flex-wrap: wrap;">
            <!-- Agent Selector -->
            <div class="channel-selector">
                <label for="agent-select" style="margin-right: 10px;">Agent:</label>
                <select id="agent-select" onchange="window.location.href='?type=<?php echo $type; ?>&channel=<?php echo $channel; ?>&agent=' + this.value + '<?php echo $name ? '&name=' . urlencode($name) : ''; ?>'">
                    <option value="wolfie" <?php echo $agentUsername === 'wolfie' ? 'selected' : ''; ?>>WOLFIE (base)</option>
                    <option value="rose" <?php echo $agentUsername === 'rose' ? 'selected' : ''; ?>>ROSE (Agent 57)</option>
                    <option value="maat" <?php echo $agentUsername === 'maat' ? 'selected' : ''; ?>>MAAT (Agent 2)</option>
                    <option value="seshat" <?php echo $agentUsername === 'seshat' ? 'selected' : ''; ?>>SESHAT (Agent 3)</option>
                </select>
            </div>
            
            <!-- Channel Selector -->
            <?php if (count($availableChannels) > 1): ?>
                <div class="channel-selector">
                    <label for="channel-select" style="margin-right: 10px;">Channel:</label>
                    <select id="channel-select" onchange="window.location.href='?type=<?php echo $type; ?>&channel=' + this.value + '&agent=<?php echo $agentUsername; ?><?php echo $name ? '&name=' . urlencode($name) : ''; ?>'">
                        <?php foreach ($availableChannels as $ch): ?>
                            <option value="<?php echo $ch; ?>" <?php echo $ch === $channel ? 'selected' : ''; ?>>
                                Channel <?php echo $ch; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Navigation -->
    <div class="definitions-nav">
        <a href="?type=collections&channel=<?php echo $channel; ?>&agent=<?php echo $agentUsername; ?>" 
           class="<?php echo $type === 'collections' ? 'active' : ''; ?>">
            📚 COLLECTIONS
        </a>
        <a href="?type=tags&channel=<?php echo $channel; ?>&agent=<?php echo $agentUsername; ?>" 
           class="<?php echo $type === 'tags' ? 'active' : ''; ?>">
            🏷️ TAGS
        </a>
        <a href="index.php" style="margin-left: auto; background: #6c757d; color: white;">
            ← Back to Viewer
        </a>
    </div>
    
    <?php if (!empty($definitions)): ?>
        <!-- Sidebar with all definitions -->
        <div class="definitions-sidebar">
            <h3>Available <?php echo strtoupper($type); ?>:</h3>
            <div class="definitions-list">
                <?php foreach (array_keys($definitions) as $defName): ?>
                    <a href="?type=<?php echo $type; ?>&channel=<?php echo $channel; ?>&agent=<?php echo $agentUsername; ?>&name=<?php echo urlencode($defName); ?>"
                       class="<?php echo $defName === $name ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($defName); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Definition Content -->
        <?php if (!empty($name) && isset($definitions[$name])): ?>
            <div class="definition-content">
                <h2><?php echo htmlspecialchars($name); ?></h2>
                <?php echo simpleMarkdownToHtml($definitions[$name]); ?>
            </div>
        <?php elseif (!empty($name)): ?>
            <div class="no-content">
                <h3>Definition Not Found</h3>
                <p>The definition for "<?php echo htmlspecialchars($name); ?>" was not found in <?php echo strtoupper($type); ?>.md for agent "<?php echo htmlspecialchars($agentUsername); ?>"</p>
                <p style="font-size: 0.9rem; margin-top: 15px; color: #6c757d;">
                    Checked: <?php echo htmlspecialchars($definitionSource); ?>
                </p>
                <a href="?type=<?php echo $type; ?>&channel=<?php echo $channel; ?>&agent=<?php echo $agentUsername; ?>" class="back-button">
                    View All Definitions
                </a>
            </div>
        <?php else: ?>
            <div class="no-content">
                <h3>Select a Definition</h3>
                <p>Click on any <?php echo $type === 'tags' ? 'tag' : 'collection'; ?> above to view its definition.</p>
                <p style="font-size: 0.9rem; margin-top: 15px; color: #6c757d;">
                    Viewing: Agent "<?php echo htmlspecialchars($agentUsername); ?>" on Channel <?php echo $channel; ?>
                </p>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="no-content">
            <h3>File Not Found</h3>
            <p>The <?php echo strtoupper($type); ?> definitions file was not found for:</p>
            <ul style="text-align: left; max-width: 600px; margin: 20px auto;">
                <li><strong>Agent:</strong> <?php echo htmlspecialchars($agentUsername); ?></li>
                <li><strong>Channel:</strong> <?php echo $channel; ?></li>
                <li><strong>Type:</strong> <?php echo strtoupper($type); ?></li>
            </ul>
            <p style="font-size: 0.9rem; margin-top: 20px;">
                <strong>3-Level Fallback Checked:</strong><br>
                1. <code><?php echo htmlspecialchars($channel . '_wolfie_' . $agentUsername . '/' . $fileName . '.md'); ?></code> (agent-specific)<br>
                2. <code><?php echo htmlspecialchars($channel . '_wolfie_wolfie/' . $fileName . '.md'); ?></code> (wolfie base)<br>
                3. <code><?php echo htmlspecialchars($channel . '_wolfie/' . $fileName . '.md'); ?></code> (legacy base)
            </p>
            <p style="font-size: 0.9rem; margin-top: 20px;">
                <strong>Result:</strong> <?php echo htmlspecialchars($definitionSource); ?>
            </p>
            <p style="font-size: 0.9rem; margin-top: 20px;">
                <strong>File exists?</strong> <?php echo file_exists($filePath) ? 'YES' : 'NO'; ?>
            </p>
            <p style="font-size: 0.9rem; margin-top: 20px;">
                <strong>MD Files Path:</strong><br>
                <code><?php echo htmlspecialchars($mdFilesPath); ?></code>
            </p>
            <?php
            // Check what's actually in the directory
            if (is_dir($mdFilesPath)) {
                echo '<p style="font-size: 0.9rem; margin-top: 20px;"><strong>Contents of md_example_files:</strong><br>';
                $items = scandir($mdFilesPath);
                foreach ($items as $item) {
                    if ($item !== '.' && $item !== '..') {
                        echo '<code>' . htmlspecialchars($item) . '</code><br>';
                    }
                }
                echo '</p>';
                
                // Check the channel directory
                $channelPath = $mdFilesPath . $channelDir;
                if (is_dir($channelPath)) {
                    echo '<p style="font-size: 0.9rem; margin-top: 20px;"><strong>Contents of ' . htmlspecialchars($channelDir) . ':</strong><br>';
                    $channelItems = scandir($channelPath);
                    foreach ($channelItems as $item) {
                        if ($item !== '.' && $item !== '..') {
                            echo '<code>' . htmlspecialchars($item) . '</code><br>';
                        }
                    }
                    echo '</p>';
                } else {
                    echo '<p style="color: red; font-size: 0.9rem; margin-top: 20px;"><strong>Directory does not exist:</strong> ' . htmlspecialchars($channelPath) . '</p>';
                }
            } else {
                echo '<p style="color: red; font-size: 0.9rem; margin-top: 20px;"><strong>MD files directory does not exist:</strong> ' . htmlspecialchars($mdFilesPath) . '</p>';
            }
            ?>
            <a href="index.php" class="back-button">← Back to Viewer</a>
        </div>
    <?php endif; ?>
</div>

