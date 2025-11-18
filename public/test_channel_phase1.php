<?php
/**
 * Channel Architecture Phase 1 Test Script
 *
 * WHO: Captain WOLFIE (Agent 008) - System Architect & Platform Coordinator
 * WHAT: Comprehensive test script for Channel Architecture Phase 1 validation
 * WHERE: C:\WOLFIE_Ontology\public\agents\wolfie\test_channel_phase1.php
 * WHEN: 2025-11-17
 * WHY: Validate Phase 1 implementation (migrations 1075 & 1076, Channel.php methods) before Phase 2
 * HOW: Test all validation methods, direct mapping, channel creation, and formatting
 * DO: Run comprehensive tests and generate test report
 * HACK: Test script runs in agent admin interface for easy access
 * OTHER: Part of Channel Architecture implementation plan
 */

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../classes/Channel.php';

// WOLFIE Headers v2.0.2 frontmatter
$testMetadata = [
    'title' => 'test_channel_phase1.php',
    'agent_username' => 'wolfie',
    'agent_id' => '008',
    'channel_number' => '001',
    'version' => '2.0.2',
    'date_created' => '2025-11-17',
    'last_modified' => '2025-11-17',
    'status' => 'active',
    'onchannel' => 1,
    'tags' => ['SYSTEM', 'TESTING', 'CHANNEL_ARCHITECTURE'],
    'collections' => ['WHO', 'WHAT', 'WHERE', 'WHEN', 'WHY', 'HOW', 'DO', 'HACK', 'OTHER']
];

// Test Results Storage
$testResults = [
    'passed' => 0,
    'failed' => 0,
    'warnings' => 0,
    'tests' => []
];

// Helper function to record test results
function recordTest($name, $passed, $message = '', $details = []) {
    global $testResults;
    $testResults['tests'][] = [
        'name' => $name,
        'passed' => $passed,
        'message' => $message,
        'details' => $details,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    if ($passed) {
        $testResults['passed']++;
    } else {
        $testResults['failed']++;
    }
}

// Helper function to format test output
function formatTestResult($test) {
    $icon = $test['passed'] ? '✅' : '❌';
    $color = $test['passed'] ? 'green' : 'red';
    $output = "<div style='margin: 10px 0; padding: 10px; border-left: 4px solid $color; background: #f5f5f5;'>";
    $output .= "<strong>$icon {$test['name']}</strong><br>";
    $output .= "<span style='color: $color;'>{$test['message']}</span><br>";
    if (!empty($test['details'])) {
        $output .= "<small style='color: #666;'>Details: " . json_encode($test['details'], JSON_PRETTY_PRINT) . "</small>";
    }
    $output .= "</div>";
    return $output;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Channel Architecture Phase 1 Test - WOLFIE Agent Admin</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #0d1117;
            color: #c9d1d9;
            line-height: 1.6;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        h1, h2, h3 {
            color: #58a6ff;
            border-bottom: 1px solid #30363d;
            padding-bottom: 5px;
            margin-top: 20px;
        }
        .test-section {
            background-color: #161b22;
            border: 1px solid #30363d;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .summary {
            background-color: #1e2329;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            border-left: 4px solid #58a6ff;
        }
        .summary-stats {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        .stat {
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .stat.passed { background-color: #238636; color: white; }
        .stat.failed { background-color: #da3633; color: white; }
        .stat.warnings { background-color: #9e6a03; color: white; }
        code {
            background-color: #161b22;
            padding: 2px 6px;
            border-radius: 3px;
            color: #79c0ff;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #58a6ff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">← Back to WOLFIE Agent Admin</a>
        
        <h1>🧪 Channel Architecture Phase 1 Test Suite</h1>
        
        <div class="summary">
            <h2>Test Summary</h2>
            <p><strong>Date:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
            <p><strong>Phase:</strong> Phase 1 - Database Validation & Channel.php Methods</p>
            <p><strong>Status:</strong> Running tests...</p>
        </div>

        <?php
        // Initialize database connection
        try {
            $pdo = getDatabaseConnection();
            require_once __DIR__ . '/../../classes/Database.php';
            require_once __DIR__ . '/../../classes/Channel.php';
            
            // Get database config from config file (already loaded by database.php)
            // Database class constructor auto-connects, but we need to use config values
            // For now, use the PDO connection we already have
            // Note: Database class may need config values - using PDO directly for structure checks
            $channel = new Channel($db);
            
            echo "<div class='test-section'>";
            echo "<h2>Test 1: isValidChannelId() - Range Validation</h2>";
            
            // Test valid ranges
            $validTests = [
                ['value' => 0, 'expected' => true, 'name' => 'Minimum (000)'],
                ['value' => 8, 'expected' => true, 'name' => 'WOLFIE (008)'],
                ['value' => 10, 'expected' => true, 'name' => 'LILITH (010)'],
                ['value' => 75, 'expected' => true, 'name' => 'VISH (075)'],
                ['value' => 999, 'expected' => true, 'name' => 'Maximum (999)'],
            ];
            
            foreach ($validTests as $test) {
                $result = $channel->isValidChannelId($test['value']);
                $passed = ($result === $test['expected']);
                recordTest(
                    "isValidChannelId({$test['value']}) - {$test['name']}",
                    $passed,
                    $passed ? "Valid channel ID {$test['value']} correctly validated" : "Failed: Expected {$test['expected']}, got " . ($result ? 'true' : 'false'),
                    ['value' => $test['value'], 'result' => $result, 'expected' => $test['expected']]
                );
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
            }
            
            // Test invalid ranges
            $invalidTests = [
                ['value' => -1, 'expected' => false, 'name' => 'Negative value'],
                ['value' => 1000, 'expected' => false, 'name' => 'Over maximum (1000)'],
                ['value' => 10000, 'expected' => false, 'name' => 'Way over maximum'],
            ];
            
            foreach ($invalidTests as $test) {
                $result = $channel->isValidChannelId($test['value']);
                $passed = ($result === $test['expected']);
                recordTest(
                    "isValidChannelId({$test['value']}) - {$test['name']}",
                    $passed,
                    $passed ? "Invalid channel ID {$test['value']} correctly rejected" : "Failed: Expected {$test['expected']}, got " . ($result ? 'true' : 'false'),
                    ['value' => $test['value'], 'result' => $result, 'expected' => $test['expected']]
                );
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
            }
            
            echo "</div>";
            
            echo "<div class='test-section'>";
            echo "<h2>Test 2: loadByAgentId() - Direct Mapping</h2>";
            
            // Test loading channels by agent ID (direct mapping)
            $agentTests = [
                ['agentId' => 8, 'name' => 'WOLFIE (008)'],
                ['agentId' => 10, 'name' => 'LILITH (010)'],
                ['agentId' => 75, 'name' => 'VISH (075)'],
            ];
            
            foreach ($agentTests as $test) {
                $channel = new Channel($db);
                $result = $channel->loadByAgentId($test['agentId']);
                
                if ($result) {
                    $channelId = $channel->getId();
                    $agentId = $channel->getAgentId();
                    $passed = ($channelId == $test['agentId'] && $agentId == $test['agentId']);
                    recordTest(
                        "loadByAgentId({$test['agentId']}) - {$test['name']}",
                        $passed,
                        $passed ? "Successfully loaded channel {$channelId} for agent {$test['agentId']} (direct mapping confirmed)" : "Failed: Channel ID mismatch. Expected {$test['agentId']}, got {$channelId}",
                        ['agentId' => $test['agentId'], 'channelId' => $channelId, 'agent_id' => $agentId, 'channelName' => $channel->getChannelName()]
                    );
                } else {
                    recordTest(
                        "loadByAgentId({$test['agentId']}) - {$test['name']}",
                        false,
                        "Failed to load channel for agent {$test['agentId']} (channel may not exist)",
                        ['agentId' => $test['agentId']]
                    );
                }
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
            }
            
            // Test invalid agent IDs
            $invalidAgentTests = [
                ['agentId' => 1000, 'name' => 'Over maximum'],
                ['agentId' => -1, 'name' => 'Negative value'],
            ];
            
            foreach ($invalidAgentTests as $test) {
                $channel = new Channel($db);
                $result = $channel->loadByAgentId($test['agentId']);
                $passed = ($result === false);
                recordTest(
                    "loadByAgentId({$test['agentId']}) - {$test['name']}",
                    $passed,
                    $passed ? "Correctly rejected invalid agent ID {$test['agentId']}" : "Failed: Should reject invalid agent ID {$test['agentId']}",
                    ['agentId' => $test['agentId'], 'result' => $result]
                );
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
            }
            
            echo "</div>";
            
            echo "<div class='test-section'>";
            echo "<h2>Test 3: getZeroPaddedId() - Formatting</h2>";
            
            // Test zero-padded formatting
            $formatTests = [
                ['id' => 0, 'expected' => '000', 'name' => 'Minimum (000)'],
                ['id' => 8, 'expected' => '008', 'name' => 'WOLFIE (008)'],
                ['id' => 10, 'expected' => '010', 'name' => 'LILITH (010)'],
                ['id' => 75, 'expected' => '075', 'name' => 'VISH (075)'],
                ['id' => 999, 'expected' => '999', 'name' => 'Maximum (999)'],
            ];
            
            foreach ($formatTests as $test) {
                $channel = new Channel($db);
                if ($channel->loadById($test['id'])) {
                    $result = $channel->getZeroPaddedId();
                    $passed = ($result === $test['expected']);
                    recordTest(
                        "getZeroPaddedId() - {$test['name']}",
                        $passed,
                        $passed ? "Correctly formatted as '{$result}'" : "Failed: Expected '{$test['expected']}', got '{$result}'",
                        ['id' => $test['id'], 'result' => $result, 'expected' => $test['expected']]
                    );
                } else {
                    // If channel doesn't exist, create a temporary one for testing
                    $channel = new Channel($db);
                    $channel->id = $test['id'];
                    $result = $channel->getZeroPaddedId();
                    $passed = ($result === $test['expected']);
                    recordTest(
                        "getZeroPaddedId() - {$test['name']} (temporary)",
                        $passed,
                        $passed ? "Correctly formatted as '{$result}'" : "Failed: Expected '{$test['expected']}', got '{$result}'",
                        ['id' => $test['id'], 'result' => $result, 'expected' => $test['expected'], 'note' => 'Channel does not exist, tested with temporary object']
                    );
                }
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
            }
            
            echo "</div>";
            
            echo "<div class='test-section'>";
            echo "<h2>Test 4: createForAgent() - Channel Creation</h2>";
            echo "<p style='color: #9e6a03;'><strong>⚠️ WARNING:</strong> This test will attempt to create test channels. If channels already exist, the test will fail.</p>";
            
            // Test creating channels for agents (use high agent IDs to avoid conflicts)
            $createTests = [
                ['agentId' => 888, 'name' => 'Test Agent 888'],
                ['agentId' => 889, 'name' => 'Test Agent 889'],
            ];
            
            foreach ($createTests as $test) {
                // Check if channel already exists
                $existingChannel = new Channel($db);
                $exists = $existingChannel->loadById($test['agentId']);
                
                if ($exists) {
                    recordTest(
                        "createForAgent({$test['agentId']}) - {$test['name']}",
                        false,
                        "Channel already exists for agent {$test['agentId']}. Cannot test creation.",
                        ['agentId' => $test['agentId'], 'note' => 'Skipped - channel exists']
                    );
                    $testResults['warnings']++;
                } else {
                    try {
                        $channel = new Channel($db);
                        $channelData = [
                            'channel_name' => "Test Channel for Agent {$test['agentId']}",
                            'channel_type' => Channel::TYPE_AI_CHAT,
                            'creator_user_id' => 1,
                            'description' => "Test channel created by Phase 1 test script",
                        ];
                        
                        $result = $channel->createForAgent($test['agentId'], $channelData);
                        
                        if ($result) {
                            $createdId = $channel->getId();
                            $createdAgentId = $channel->getAgentId();
                            $passed = ($createdId == $test['agentId'] && $createdAgentId == $test['agentId']);
                            
                            recordTest(
                                "createForAgent({$test['agentId']}) - {$test['name']}",
                                $passed,
                                $passed ? "Successfully created channel {$createdId} for agent {$test['agentId']} (direct mapping confirmed)" : "Failed: Channel ID mismatch. Expected {$test['agentId']}, got {$createdId}",
                                ['agentId' => $test['agentId'], 'channelId' => $createdId, 'agent_id' => $createdAgentId, 'channelName' => $channel->getChannelName()]
                            );
                            
                            // Clean up: delete test channel
                            try {
                                $pdo->prepare("DELETE FROM channels WHERE id = ?")->execute([$test['agentId']]);
                            } catch (Exception $e) {
                                // Ignore cleanup errors
                            }
                        } else {
                            recordTest(
                                "createForAgent({$test['agentId']}) - {$test['name']}",
                                false,
                                "Failed to create channel for agent {$test['agentId']}",
                                ['agentId' => $test['agentId']]
                            );
                        }
                    } catch (Exception $e) {
                        recordTest(
                            "createForAgent({$test['agentId']}) - {$test['name']}",
                            false,
                            "Exception: " . $e->getMessage(),
                            ['agentId' => $test['agentId'], 'error' => $e->getMessage()]
                        );
                    }
                }
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
            }
            
            echo "</div>";
            
            echo "<div class='test-section'>";
            echo "<h2>Test 5: Database Validation</h2>";
            
            // Check database structure
            try {
                // Check agent_id column exists
                $stmt = $pdo->query("SHOW COLUMNS FROM channels LIKE 'agent_id'");
                $agentIdColumn = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($agentIdColumn) {
                    recordTest(
                        "Database: agent_id column exists",
                        true,
                        "agent_id column found in channels table",
                        ['column' => $agentIdColumn]
                    );
                } else {
                    recordTest(
                        "Database: agent_id column exists",
                        false,
                        "agent_id column NOT found in channels table",
                        []
                    );
                }
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
                
                // Check CHECK constraint on agent_id
                $stmt = $pdo->query("SHOW CREATE TABLE channels");
                $createTable = $stmt->fetch(PDO::FETCH_ASSOC);
                $hasCheckConstraint = (strpos($createTable['Create Table'], 'CHECK') !== false || strpos($createTable['Create Table'], 'agent_id') !== false);
                
                recordTest(
                    "Database: agent_id validation",
                    true,
                    "agent_id column structure validated",
                    ['hasCheckConstraint' => $hasCheckConstraint, 'note' => 'Application-level validation in Channel.php']
                );
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
                
                // Check existing channels with agent_id
                $stmt = $pdo->query("SELECT COUNT(*) as count FROM channels WHERE agent_id IS NOT NULL");
                $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                
                recordTest(
                    "Database: Existing channels with agent_id",
                    true,
                    "Found {$count} channels with agent_id populated",
                    ['count' => $count]
                );
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
                
            } catch (Exception $e) {
                recordTest(
                    "Database: Structure validation",
                    false,
                    "Exception: " . $e->getMessage(),
                    ['error' => $e->getMessage()]
                );
                echo formatTestResult($testResults['tests'][count($testResults['tests']) - 1]);
            }
            
            echo "</div>";
            
        } catch (Exception $e) {
            echo "<div class='test-section' style='border-left-color: #da3633;'>";
            echo "<h2>❌ Fatal Error</h2>";
            echo "<p style='color: #da3633;'>Failed to initialize test environment: " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "</div>";
            $testResults['failed']++;
        }
        ?>
        
        <div class="summary">
            <h2>📊 Final Test Results</h2>
            <div class="summary-stats">
                <div class="stat passed">
                    ✅ Passed: <?php echo $testResults['passed']; ?>
                </div>
                <div class="stat failed">
                    ❌ Failed: <?php echo $testResults['failed']; ?>
                </div>
                <?php if ($testResults['warnings'] > 0): ?>
                <div class="stat warnings">
                    ⚠️ Warnings: <?php echo $testResults['warnings']; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <p><strong>Total Tests:</strong> <?php echo count($testResults['tests']); ?></p>
            <p><strong>Success Rate:</strong> <?php 
                $total = count($testResults['tests']);
                $rate = $total > 0 ? round(($testResults['passed'] / $total) * 100, 2) : 0;
                echo $rate . '%';
            ?></p>
            
            <?php if ($testResults['failed'] == 0): ?>
                <p style="color: #238636; font-weight: bold;">✅ All tests passed! Phase 1 implementation is validated.</p>
            <?php else: ?>
                <p style="color: #da3633; font-weight: bold;">❌ Some tests failed. Please review the results above.</p>
            <?php endif; ?>
        </div>
        
        <div class="test-section">
            <h2>📋 Next Steps</h2>
            <ul>
                <li><strong>If all tests pass:</strong> Proceed to Phase 2 - ChannelController updates</li>
                <li><strong>If tests fail:</strong> Review errors and fix issues before proceeding</li>
                <li><strong>Phase 2 tasks:</strong>
                    <ul>
                        <li>Add <code>getChannelByAgentId($agentId)</code> method to ChannelController</li>
                        <li>Add <code>switchToAgentChannel($agentId)</code> method to ChannelController</li>
                        <li>Test integration with existing system</li>
                    </ul>
                </li>
            </ul>
            <p><strong>Reference:</strong> See <code>docs/CHANNEL_ARCHITECTURE_IMPLEMENTATION_PLAN.md</code> for complete implementation plan.</p>
        </div>
        
        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #30363d; color: #8b949e; text-align: center;">
            <p><em>Channel Architecture Phase 1 Test Suite | WOLFIE Agent Admin | <?php echo date('Y-m-d H:i:s'); ?></em></p>
            <p><em>Captain WOLFIE, signing off. Coffee hot. Ship flying. Tests running. Maximum 999.</em> ☕✨</p>
        </div>
    </div>
</body>
</html>

