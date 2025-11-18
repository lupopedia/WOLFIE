<?php
/**
 * WOLFIE Agent Interface - System Architect & Platform Coordinator
 *
 * WHO: WOLFIE (System Agent)
 * WHAT: Web interface for system architecture and platform coordination
 * WHERE: C:\WOLFIE_Ontology\public\agents\wolfie\index.php
 * WHEN: 2025-11-04
 * WHY: Provide dedicated interface for WOLFIE system tools and documentation
 * HOW: Navigation menu with system tools, documentation, and configuration
 * PURPOSE: System integrity and platform coordination
 * KEY: AGENT_INTERFACE, SYSTEM_TOOLS, WOLFIE_HEADERS
 * TITLE: WOLFIE Agent Interface
 * ID: WOLFIE_INTERFACE_20251104
 * SUPERPOSITIONALLY: ["agent_interface", "system_tools", "wolfie"]
 * DATE: 2025-11-04
 * WORKFLOW_STATE: ACTIVE
 * PLAN: System architecture interface
 * AI_ROUTE: [CURSOR_AI: TECHNICAL_ANALYSIS, SYSTEM_MANAGEMENT]
 * HEART_CENTERED: [SYSTEM_INTEGRITY]
 * CAPTAIN_APPROVAL: PENDING
 * SEMANTIC_MAPPING: WOLFIE_INTERFACE=System agent web interface with navigation and tools
 */

// TODO: Add permission check when ready
// require_once __DIR__ . '/../_shared/AgentPermissionChecker.php';
// session_start();
// $userId = $_SESSION['user_id'] ?? null;
// if (!AgentPermissionChecker::canAccessAgent($userId, 'wolfie')) {
//     header('Location: /agents/access_denied.php?agent=wolfie');
//     exit;
// }

require_once __DIR__ . '/../../config/database.php';

// Read SESSION_GLOBALS for current date/time
$sessionGlobalsPath = __DIR__ . '/../../../md_files/1_wolfie/SESSION_GLOBALS.md';
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

if (file_exists($sessionGlobalsPath)) {
    $content = file_get_contents($sessionGlobalsPath);
    if (preg_match('/current_date:\s*(.*)$/m', $content, $matches)) {
        $currentDate = trim($matches[1]);
    }
    if (preg_match('/current_time:\s*(.*)$/m', $content, $matches)) {
        $currentTime = trim($matches[1]);
    }
}

// Get WOLFIE agent config from database or CSV
$wolfieAvatar = '🐺'; // Default emoji fallback
$wolfieDisplayName = 'WOLFIE';
$wolfieRole = 'System Architect & Platform Coordinator';

try {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT avatar, display_name, bio FROM agents WHERE username = 'WOLFIE' AND is_active = 1 LIMIT 1");
    $stmt->execute();
    $agent = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($agent) {
        // Use avatar image if exists, otherwise fall back to emoji
        if (!empty($agent['avatar']) && file_exists(__DIR__ . '/../../' . $agent['avatar'])) {
            $wolfieAvatar = '<img src="/' . htmlspecialchars($agent['avatar']) . '" alt="WOLFIE" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid rgba(255,255,255,0.3);">';
        }
        if (!empty($agent['display_name'])) {
            $wolfieDisplayName = $agent['display_name'];
        }
        // Extract first sentence from bio as role
        if (!empty($agent['bio'])) {
            $bioLines = explode('.', $agent['bio']);
            if (!empty($bioLines[0])) {
                // Try to extract role from bio (after first colon)
                if (strpos($bioLines[0], ':') !== false) {
                    $parts = explode(':', $bioLines[0], 2);
                    if (count($parts) > 1) {
                        $wolfieRole = trim($parts[1]);
                    }
                }
            }
        }
    }
} catch (Exception $e) {
    // Fall back to CSV if database fails
    $csvPath = __DIR__ . '/../../../data/csv/agents_rows.csv';
    if (file_exists($csvPath)) {
        $csvData = file($csvPath);
        foreach ($csvData as $index => $line) {
            if ($index < 2) continue; // Skip header rows
            $fields = str_getcsv($line);
            if (isset($fields[1]) && strtoupper($fields[1]) === 'WOLFIE') {
                // Field 4 is avatar
                if (!empty($fields[4]) && file_exists(__DIR__ . '/../../' . $fields[4])) {
                    $wolfieAvatar = '<img src="/' . htmlspecialchars($fields[4]) . '" alt="WOLFIE" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid rgba(255,255,255,0.3);">';
                }
                // Field 2 is display_name
                if (!empty($fields[2])) {
                    $wolfieDisplayName = $fields[2];
                }
                // Field 5 is bio
                if (!empty($fields[5])) {
                    $bioLines = explode('.', $fields[5]);
                    if (!empty($bioLines[0])) {
                        if (strpos($bioLines[0], ':') !== false) {
                            $parts = explode(':', $bioLines[0], 2);
                            if (count($parts) > 1) {
                                $wolfieRole = trim($parts[1]);
                            }
                        }
                    }
                }
                break;
            }
        }
    }
}

// Get active section from query string
$activeSection = $_GET['section'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOLFIE - System Architect & Platform Coordinator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            display: flex;
            min-height: 100vh;
        }
        
        /* Left Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #6f42c1 0%, #563d7c 100%);
            color: white;
            padding: 20px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .agent-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }
        
        .agent-avatar {
            font-size: 4em;
            margin-bottom: 10px;
        }
        
        .agent-name {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .agent-role {
            font-size: 0.9em;
            opacity: 0.8;
        }
        
        .session-info {
            background: rgba(0,0,0,0.2);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.85em;
        }
        
        .session-info h3 {
            margin-bottom: 10px;
            font-size: 1em;
            color: #ffc107;
        }
        
        .session-info p {
            margin: 5px 0;
        }
        
        .nav-section {
            margin-bottom: 25px;
        }
        
        .nav-section h4 {
            font-size: 0.9em;
            margin-bottom: 10px;
            opacity: 0.7;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .nav-menu {
            list-style: none;
        }
        
        .nav-menu li {
            margin-bottom: 5px;
        }
        
        .nav-menu a {
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        
        .nav-menu a:hover {
            background: rgba(255,255,255,0.1);
        }
        
        .nav-menu a.active {
            background: #ffc107;
            color: #343a40;
        }
        
        .nav-menu a .icon {
            margin-right: 10px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 30px;
        }
        
        .content-header {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .content-header h1 {
            color: #6f42c1;
            margin-bottom: 10px;
        }
        
        .content-header p {
            color: #6c757d;
        }
        
        .tool-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .tool-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-left: 4px solid #6f42c1;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .tool-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .tool-card h3 {
            color: #6f42c1;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .tool-card h3 .icon {
            margin-right: 10px;
            font-size: 1.2em;
        }
        
        .tool-card p {
            color: #6c757d;
            margin-bottom: 15px;
            line-height: 1.6;
        }
        
        .tool-card .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #6f42c1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        
        .tool-card .btn:hover {
            background: #563d7c;
        }
        
        .warning-banner {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .warning-banner h3 {
            color: #856404;
            margin-bottom: 10px;
        }
        
        .warning-banner p {
            color: #856404;
        }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <div class="agent-header">
            <div class="agent-avatar"><?= $wolfieAvatar ?></div>
            <div class="agent-name"><?= htmlspecialchars($wolfieDisplayName) ?></div>
            <div class="agent-role"><?= htmlspecialchars($wolfieRole) ?></div>
        </div>
        
        <div class="session-info">
            <h3>📅 Session Info</h3>
            <p><strong>Date:</strong> <?= htmlspecialchars($currentDate) ?></p>
            <p><strong>Time:</strong> <?= htmlspecialchars($currentTime) ?></p>
            <p><strong>Project:</strong> WOLFIE Ontology</p>
            <p><strong>Status:</strong> <span style="color: #2ecc71;">● Online</span></p>
        </div>
        
        <div class="nav-section">
            <h4>Navigation</h4>
            <ul class="nav-menu">
                <li><a href="index.php" class="<?= $activeSection === 'home' ? 'active' : '' ?>">
                    <span class="icon">🏠</span> Home
                </a></li>
            </ul>
        </div>
        
        <div class="nav-section">
            <h4>Documentation System</h4>
            <ul class="nav-menu">
                <li><a href="index.php?section=wolfie_headers" class="<?= $activeSection === 'wolfie_headers' ? 'active' : '' ?>">
                    <span class="icon">📋</span> WOLFIE Headers System
                </a></li>
                <li><a href="index.php?section=tags" class="<?= $activeSection === 'tags' ? 'active' : '' ?>">
                    <span class="icon">🏷️</span> TAGS System
                </a></li>
                <li><a href="index.php?section=collections" class="<?= $activeSection === 'collections' ? 'active' : '' ?>">
                    <span class="icon">📚</span> COLLECTIONS System
                </a></li>
            </ul>
        </div>
        
        <div class="nav-section">
            <h4>System Tools</h4>
            <ul class="nav-menu">
                <li><a href="../../update_session_globals.php" target="_blank">
                    <span class="icon">📅</span> Update Session Globals
                </a></li>
                <li><a href="../../export_all_tables_to_csv.php" target="_blank">
                    <span class="icon">📤</span> Export Database to CSV
                </a></li>
            </ul>
        </div>
        
        <div class="nav-section">
            <h4>Agent Management</h4>
            <ul class="nav-menu">
                <li><a href="../lupo/" target="_blank">
                    <span class="icon">🗄️</span> LUPO (Database)
                </a></li>
            </ul>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <?php if ($activeSection === 'wolfie_headers'): ?>
            <?php 
            ob_start();
            include __DIR__ . '/section/index.php';
            $content = ob_get_clean();
            if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $content, $matches)) {
                echo $matches[1];
            } else {
                echo $content;
            }
            ?>
        <?php elseif ($activeSection === 'tags'): ?>
            <?php 
            // Include TAGS definition page
            echo '<div class="content-header">';
            echo '<h1>🏷️ TAGS System</h1>';
            echo '<p>Available tags for WOLFIE Header System</p>';
            echo '</div>';
            if (file_exists(__DIR__ . '/section/definitions.php')) {
                ob_start();
                $_GET['type'] = 'tags';
                include __DIR__ . '/section/definitions.php';
                $content = ob_get_clean();
                if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $content, $matches)) {
                    echo $matches[1];
                } else {
                    echo $content;
                }
            }
            ?>
        <?php elseif ($activeSection === 'collections'): ?>
            <?php 
            // Include COLLECTIONS definition page
            echo '<div class="content-header">';
            echo '<h1>📚 COLLECTIONS System</h1>';
            echo '<p>Available collections for WOLFIE Header System</p>';
            echo '</div>';
            if (file_exists(__DIR__ . '/section/definitions.php')) {
                ob_start();
                $_GET['type'] = 'collections';
                include __DIR__ . '/section/definitions.php';
                $content = ob_get_clean();
                if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $content, $matches)) {
                    echo $matches[1];
                } else {
                    echo $content;
                }
            }
            ?>
        <?php elseif ($activeSection === 'home'): ?>
            <div class="content-header">
                <h1>🐺 Welcome to WOLFIE's System Workshop</h1>
                <p>System architecture, platform coordination, and AGAPE principles</p>
            </div>
            
            <div class="warning-banner">
                <h3>⚠️ RESTRICTED ACCESS</h3>
                <p>This agent handles system architecture and platform coordination. Only authorized users with <code>access_agent_wolfie</code> permission should access this interface.</p>
            </div>
            
            <h2 style="margin-bottom: 20px; color: #6f42c1;">Documentation System</h2>
            <div class="tool-grid">
                <div class="tool-card">
                    <h3><span class="icon">📋</span> WOLFIE Headers System</h3>
                    <p>Complete documentation and examples for the WOLFIE Header System using YAML frontmatter.</p>
                    <a href="index.php?section=wolfie_headers" class="btn">View Documentation</a>
                </div>
                
                <div class="tool-card">
                    <h3><span class="icon">🏷️</span> TAGS System</h3>
                    <p>Browse and understand all available TAGS for organizing documentation across the platform.</p>
                    <a href="index.php?section=tags" class="btn">Browse Tags</a>
                </div>
                
                <div class="tool-card">
                    <h3><span class="icon">📚</span> COLLECTIONS System</h3>
                    <p>Explore COLLECTIONS definitions (WHO, WHAT, WHERE, WHEN, WHY, HOW, HELP) for documentation.</p>
                    <a href="index.php?section=collections" class="btn">Browse Collections</a>
                </div>
            </div>
            
            <h2 style="margin-bottom: 20px; color: #6f42c1;">System Tools</h2>
            <div class="tool-grid">
                <div class="tool-card">
                    <h3><span class="icon">📅</span> Update Session Globals</h3>
                    <p>Update daily session information: date, time, location, and priorities for AI agents.</p>
                    <a href="../../update_session_globals.php" class="btn" target="_blank">Update Session</a>
                </div>
                
                <div class="tool-card">
                    <h3><span class="icon">📤</span> Export Database to CSV</h3>
                    <p>Export all database tables to CSV format for analysis and version control.</p>
                    <a href="../../export_all_tables_to_csv.php" class="btn" target="_blank">Export Database</a>
                </div>
            </div>
            
            <h2 style="margin-bottom: 20px; color: #6f42c1;">System Philosophy</h2>
            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <h3 style="color: #6f42c1; margin-bottom: 15px;">The WOLFIE Way</h3>
                <p style="margin-bottom: 15px;">WOLFIE coordinates the entire platform using AGAPE principles:</p>
                
                <h4 style="color: #6f42c1; margin: 15px 0 10px 0;">Core Principles</h4>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li><strong>Patience (P)</strong> - Build systems carefully and methodically</li>
                    <li><strong>Kindness (K)</strong> - Design with user needs first</li>
                    <li><strong>Humility (H)</strong> - Learn from mistakes and improve</li>
                    <li><strong>Truth (T)</strong> - Maintain data integrity and transparency</li>
                    <li><strong>Protection (PR)</strong> - Secure data and user privacy</li>
                </ul>
                
                <h4 style="color: #6f42c1; margin: 15px 0 10px 0;">Fallback Philosophy</h4>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>Always have multiple layers of fallbacks</li>
                    <li>Build from the bottom up (worst case → best case)</li>
                    <li>Test constraints intentionally</li>
                    <li>Graceful degradation, not catastrophic failure</li>
                </ul>
                
                <h4 style="color: #6f42c1; margin: 15px 0 10px 0;">Zero Dependencies</h4>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>Learn from frameworks (Laravel, Symfony)</li>
                    <li>Implement best practices ourselves</li>
                    <li>Avoid external dependencies</li>
                    <li>Maximum portability and control</li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

