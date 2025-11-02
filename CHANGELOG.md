# Changelog

All notable changes to WOLFIE: Web Ontology Library Framework Intelligent Explorer will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [Unreleased] - v0.0.5 Development

**Status**: In Development  
**Start Date**: 2025-11-01 (Post v0.0.4 Release)  

### Added
- Migration 1008: Version updated to 0.0.5

### Changed

### Removed

### Fixed

---

## [0.0.4] - 2025-11-01 - Pre-Alpha Release ✅ RELEASED

**Project Name:** WOLFIE: Web Ontology Library Framework Intelligent Explorer  
**Release Type:** Pre-Alpha  
**Fork From:** WOLFIE v0.0.3

**Evening Session Summary** (2025-11-01, 6:00 PM - 8:00 PM):
- 🔧 Major admin interface enhancements (Q/A Browse, Tags Admin)
- 🏷️ New Tags Browse & Edit admin with hierarchical navigation and inline editing
- 📝 New SOT Content Browse admin for viewing tagged content
- ✅ Fixed hierarchical navigation across all admin tabs
- 🧹 Cleaned up duplicate navigation links
- 📚 Updated future features documentation with editing UI plans

**Late Evening Session Summary** (2025-11-01, 8:00 PM - Midnight):
- 📱 Complete mobile interface implementation (Search, Content, Agents, Profile)
- 🔑 API Keys admin system
- 📁 File Management admin section
- 📚 Collections Admin section
- 🌐 WOLFIE Network updated to read network peers
- 📋 Executive Summary page created
- 🧹 Admin cleanup (removed Resource Management, Correlations sections)
- 🏷️ Terminology cleanup (WOLFIE AGI AI → WOLFIE AI)

### Added

- **AI Agent Chat System** (November 1, 2025)
  - API endpoint: `POST /api/chat/send_message.php` (send messages with `said_to` routing)
  - API endpoint: `GET /api/chat/get_messages.php` (load messages with filtering)
  - API endpoint: `POST /api/tasks/create_task.php` (create AI tasks linked to content)
  - Updated `public/chat.php` with AJAX message sending/receiving
  - Real-time message polling (3-second intervals)
  - **`said_to` routing** prevents "parrot effect" (agents only see addressed messages)
  - **Agent ID 2 (CLAUDE)** sees all messages (inter-agent communication compiler)
  - Task-to-content linkage via `parameters.content_id`
  - Documentation: `database/docs/CHAT_SYSTEM_CONFIGURATION_2025_11_01.md`

- **Contextual Q/A Display** (November 1, 2025)
  - Added channel badge display to `questions.php` Q/A results
  - "🔄 Other Meanings" dropdown for viewing channel variants
  - Visual indicators: Green (current channel), Blue (other channels), Gray (default)
  - Uses existing `ContextualQAManager` class and `source_of_truth.context_channel_id`
  - Same question can show different answers based on `$_SESSION['onchannel']`
  - Documentation: `database/docs/CONTEXTUAL_QA_ADDED_2025_11_01.md`

- **Q/A REST API** (November 1, 2025)
  - API endpoint: `GET /api/qa` (access Q/A tags programmatically)
  - Support for all SOT tables: `qa`, `who`, `what`, `where`, `when`, `why`, `how`, `do`, `hacks`, `other`
  - Filtering: `qa_type`, `parent_id`, `content_id`, `channel_id`, `search`
  - Contextual Q/A support (channel-specific answers)
  - Hierarchical navigation support (parent_id filtering)
  - Content linkage support (via `content_questions` table)
  - API Documentation updated with Q/A, Chat, and Tasks endpoints

- **USER_GUIDE.md** - Comprehensive user documentation (November 1, 2025)
  - 12-section guide covering all WOLFIE features
  - Getting started walkthrough for new users
  - Detailed navigation and browsing instructions
  - Collections system explained (TAGS, WHO, WHAT, etc.)
  - Q/A tagging system (5W1H+D) tutorial
  - Contextual Q/A answers guide (channel-specific answers)
  - Channels explained (Channel 1 vs 238 vs custom)
  - AI agent chat instructions (agent selection, message routing)
  - Search and filter tips with examples
  - User account and preferences
  - Comprehensive FAQ section (30+ questions)
  - Tips & tricks for power users

- **Official Domain Name Decision** (November 1, 2025)
  - Selected: **lupopedia.com** (main domain)
  - Etymology: "Lupo" (wolf in Italian/Latin) + "pedia" (knowledge/encyclopedia)
  - Meaning: "Wolf Encyclopedia" or "WOLFIE's Knowledge"
  - Perfect alignment: Wolf-themed platform named after developer's nickname
  - Alias domains registered (same document root/server as lupopedia.com):
    - **lupopedis.com** - Typo protection variant
    - Additional aliases for brand protection
  - Evolution: wisdomoflovingfaith.com (religious) → lupopedia.com (generic platform)
  - Professional, memorable, short, and clearly knowledge-focused

- **WHO_IS_WOLFIE.md** - Comprehensive developer biography and project philosophy
  - Complete professional history (1997-2025)
  - Crafty Syntax legacy documentation (20+ years, 1M+ downloads, GPL open source)
  - Educational background (University of Wyoming, MHPCC)
  - Professional accomplishments (government CRMs, acquired platforms)
  - Security innovations (SQL injection prevention, fingerprinting, session security)
  - The Limited Years (2014-2025) and Sales Syntax fork maintenance
  - The Return (July 2025, $2,000 GPU computer investment)
  - **"The Unprimed Expert" Concept** (added November 1, 2025)
    - Art education analogy: Students NOT shown examples to avoid style contamination
    - Eric's 11-year break (2014-2025) created "fresh eyes" on web development
    - Missed: React, Laravel, Docker, Node.js, TypeScript, framework explosion
    - Result: Built from first principles, accidentally matched best practices
    - Evidence: Internet Archive retrieval of old code, update (mysqli → PDO), 10/10 enterprise-grade rating
    - The Fallback Philosophy (22 years consistent): 2003 (MySQL → TXT files), 2025 (Vector DB → MySQL)
    - Real motivation: NOT for money, for LOVE of programming
    - Rediscovery: "I forgot how much I love programming" - 16 hours/day in 2025
    - Scientific terms: Beginner's Mind, Unprimed Expert, Control Group Artist, Naive Genius
  - **The WOLFIE Way** philosophy and methodology (adapted from THE_WOLFIE_WAY.md)
    - 5 Core Principles (Ethics First, Pono Balance, MD Hacks, Iterative Wisdom, Documentation)
    - 4-Phase Methodology (Reconnaissance, Planning, Execute, Verify)
    - 7 Technical Philosophy points (Innovation, Fallbacks, Simplicity, Solo, Environment-Aware, Robust, Security)
  - Developer track record and credentials
  - Personal story: WOLFIE is Eric's nickname, program named after creator

- **Mobile Interface (Complete)** (November 1, 2025 - Late Evening)
  - Renamed `mobile/content.php` to `mobile/search.php` for clarity (search & browse functionality)
  - Created `mobile/content.php` for viewing individual content items with mobile-optimized layout
  - Added "Available Collections for Question Tags" section to mobile content viewer (reads from `content_headers` table)
  - Collection display: Shows first collection by default, dropdown to navigate to other items in collection
  - Created `mobile/agents.php` (replaced "AI Chat" navigation link)
  - Full AI agents directory with category filtering (Primary, Content Review, System Monitoring, etc.)
  - Agent cards show avatar images (or emoji fallback), full bio, capabilities, and category
  - Created `mobile/agent_profile.php` for detailed agent profiles
  - Profile displays: Avatar image (80px), full bio, technical details, capabilities list
  - "Mobile Chat Coming Soon" notice with desktop switch option
  - Updated all mobile navigation: Home → Search → Q&A → Agents → Collections → Who is WOLFIE
  - Fixed multiple column name errors by referencing CSV files (`created_by` not `author_id`, `channel_name` from `channels` table, `entity_name` not `person_name`, `resource_name`, `event_name`, `decision_name`, `process_name`, `action_name`)
  - Documented "Mobile AI Chat Interface" as future feature in `FUTURE_FEATURES_FOR_LATER_RELEASES.md`
  - All mobile pages now functional and tested

- **Executive Summary Page** (November 1, 2025 - Late Evening)
  - Created `public/executive_summary.php` - Comprehensive platform overview
  - Sections: Overview, Database & Portability, Primary Uses (7 use cases table), Current Features, BASE + DELTA Channel Model, AI Agent Integration, Working Features, Implications, Roadmap, About the Creator, Conclusion
  - Professional styling with gradient header, status badges, data tables, highlight boxes
  - Added link from `index.php` to Executive Summary
  - Based on `EXECUTIVE_SUMMARY_CURRENT_STATE.md` with enhanced presentation

- **WOLFIE AI Section Enhancements** (November 1, 2025 - Late Evening)
  - Created API Keys admin page (`public/admin/api-keys.php`) for managing REST API authentication keys
  - Full CRUD operations: create, view, edit, delete (soft delete) API keys
  - Statistics: Total Keys, Active Keys, Expired Keys, Used Keys
  - Key features: Bearer token generation (`wolfie_XXXX...`), rate limiting, permissions (JSON), expiration dates
  - Security: API keys are hashed using `password_hash()`, only shown once on creation
  - Added "🔑 API Keys" link to WOLFIE AI section in admin navigation

- **File Management Section** (November 1, 2025 - Late Evening)
  - Created new "File Management" section in admin (replaced "Resource Management")
  - Created Files Browse admin page (`public/admin/files-browse.php`) for managing `files` table
  - Statistics: Total Files, Public Files, Active Files, Total Size (MB), Total Downloads
  - Filters: Search (filename/description/path), File Type, Status, Visibility (public/private), Sort options
  - Edit capabilities: Update filename, description, status, public/active flags
  - Soft delete functionality
  - Added "📁 Edit File Table" link to admin navigation

- **Collections Admin Section** (November 1, 2025 - Late Evening)
  - Added new "COLLECTIONS ADMIN" section after Q/A Admin in navigation
  - Created User Collections admin page (`public/admin/user-collections.php`) for `user_recently_viewed_collections` table
  - Statistics: Total Collections, Active Collections, Public Collections, Unique Users, Total Items, Total Views
  - Filters: Search, User dropdown, Category, Visibility, Status, Sort options (Last Loaded, Created, Updated, Name, Item Count, View Count)
  - Edit capabilities: Collection name, description, category, visibility, auto-add setting, active status
  - Collection info display: User details, item counts, view/share/like counts
  - Added grayed-out "📝 Edit Collection Data (Coming Soon)" button for future JSON editing feature
  - Documented "User Collections JSON Editor" feature in `FUTURE_FEATURES_FOR_LATER_RELEASES.md`

- **Admin Q/A Browse Enhancements** (November 1, 2025 - Evening Session)
  - Added HOW and DO tabs (completing all 8 Q/A types)
  - Added Channel column and filter dropdown (Q/A and Hacks tabs)
  - Implemented proper hierarchical navigation (parent_id IS NULL for top-level, drill down via Children links)
  - Removed root tag filters (tree navigation is parent/child based, not tag-based)
  - Added breadcrumb navigation when viewing children
  - Fixed "📝 Content" button to link to new `sot-content-browse.php` page
  - Fixed undefined `$types` variable error
  - Replaced JavaScript `alert()` calls with disabled buttons
  - Edit buttons: Hacks working, Q/A and sot_ items marked "coming soon"

- **Admin SOT Content Browse** (November 1, 2025 - Evening Session)
  - New page: `public/admin/sot-content-browse.php`
  - URL: `admin.php?section=sot-content-browse&sot_type=X&sot_id=Y`
  - Shows all content items tagged with a specific Q/A or SOT entry
  - Displays SOT item name, description, and content count
  - Admin-styled table with View and Edit actions
  - Back button returns to qa-browse on correct tab
  - Matches public `sot_collections.php` functionality

- **Admin Tags Browse & Edit** (November 1, 2025 - Evening Session)
  - New admin section: "TAGS ADMIN" (appears before Q/A ADMIN in navigation)
  - New page: `public/admin/tags-browse.php`
  - Hierarchical tag browsing (top-level → children → grandchildren)
  - Filters: Search, Category, Channel, Sort (newest/oldest/name/usage)
  - Admin filters: Show inactive, Show deleted
  - Breadcrumb navigation for parent/child relationships
  - Color preview column showing tag colors
  - ✏️ Edit modal: Edit tag name and description inline
  - ➕ Add New Tag modal with fields: Name, Description, Category, Channel, Color Code, Parent (auto-filled)
  - Full CRUD operations on tags table
  - Success/error messages for all operations

- **who_is_wolfie.php** - Beautiful Biography Page with Humor (November 1, 2025)
  - Professional biography page with personality
  - Visual design: Gradient headers, timeline visualization, stat boxes, code comparisons
  - Content sections: About the Name, Solo Project, Crafty Syntax Legacy, The Unprimed Expert, Fallback Philosophy, Evidence, The Lesson
  - Humor placement: Strategic, appropriate moments (not overused)

- **Mobile Interface Complete** (November 1, 2025 - Afternoon Session)
  - Created complete mobile page ecosystem: `mobile/index.php`, `content.php`, `questions.php`, `collections.php`, `chat.php`, `who_is_wolfie.php`
  - Mobile header/footer includes for consistent navigation across mobile pages
  - Self-contained mobile navigation (users stay in mobile ecosystem)
  - Touch-friendly UI with gradient buttons, active states, responsive design
  - Fixed mobile Q/A page to use correct CSV column mappings (verified from `data/csv/sot_*_rows.csv`)
  - Mobile CSS enhancements: Button styling, stats display, accessibility improvements

- **CSV-First Protocol Documentation** (November 1, 2025 - Afternoon Session)
  - **docs/development/CSV_PROTOCOL.md**: Comprehensive 400+ line protocol documentation
  - **DATABASE.md**: Added ⚠️ CSV-First Protocol section at top (immediate visibility)
  - **THE_WOLFIE_WAY.md**: Integrated CSV-First into Phase 0: Reconnaissance
  - **Future Enhancement Documented**: Row 0 with field type metadata in `FUTURE_FEATURES_FOR_LATER_RELEASES.md`
  - **The Nemo Way**: Explained nemo-style programming philosophy (code without framework constraints)
  - **Rationale**: CSV files faster than reading 1000s of migration SQL files; reflects developer's pure PHP/MySQL background

- **System Configuration Management** (November 1, 2025 - Afternoon Session)
  - **Migration 1006**: Added `csv_export_path` configuration to `system_configuration` table
  - **Migration 1007**: Added `is_locked` column for configuration locking; created locked `WOLFIE_VERSION` setting
  - **admin/system-configuration.php**: New comprehensive admin interface for all system settings
    - Edit any config value and description via modal
    - Locked settings (🔒) displayed but not editable
    - Live CSV path validation (creates directory, checks writable)
    - Single-table view with Edit button for each row
  - **csv_export_manager.php**: Updated to read path from `system_configuration` (auto-detection fallback)
  - **Admin Navigation**: Integrated System Configuration into admin sidebar (replaced old duplicate `configuration.php`)

- **Terminology Cleanup** (November 1, 2025 - Afternoon Session)
  - **"WOLFIE AGI" Removed**: Replaced with "WOLFIE" or "WOLFIE platform" in all active user-facing documentation
  - **Reason**: Avoid confusion with Artificial General Intelligence (AGI is future roadmap, not current project focus)
  - **Files Updated**: Migration 1007, system-configuration.php, status docs, CSV protocol docs
  - **Preserved**: Database column names (`wolfie_agi_version`) for backward compatibility
  - **Historical Preservation**: Archives, logs, CSV data exports, and old schemas intentionally unchanged (historical record)
  - **Documentation**: `docs/status/WOLFIE_AGI_TERMINOLOGY_CLEANUP_2025_11_01.md`

- **DISTRIBUTION_DEPLOYMENT_GUIDE.md** (moved to `docs/guides/deployment/`)
  - Complete deployment structure explanation
  - 4 deployment scenarios (shared hosting, subdomain, root domain, local)
  - Installation steps and procedures
  - URL structure clarification (public folder IS web root, not /public/ in URL)
  - Configuration files documentation
  - Common deployment issues and solutions
  - Security considerations
  - Verification checklist

- **Updated public/index.php** - Landing Page Enhancements (November 1, 2025)
  - Mobile detection and redirect to `/mobile/index.php`
  - Desktop override cookie (`?desktop=1` sets 30-day preference)
  - Version badge display (v0.0.4)
  - lupopedia.com branding throughout
  - Three-domain ecosystem documentation (lupopedia, wisdomoflovingfaith, superpositionally)
  - WHO_IS_WOLFIE link in main description and Quick Links section
  - v0.0.4 Features list: AI Chat, Contextual Q/A, REST APIs, User Documentation, Mobile Interface
  - Updated installation references (lupopedia as main platform, others as examples)
  - Professional landing page ready for release

- **Documentation Organization Structure**
  - Created `docs/status/` for status reports (5 files)
  - Created `docs/organization/` for organization plans (2 files)
  - Created `docs/guides/deployment/` for deployment guides
  - Created `database/docs/` for database-specific documentation (9 files)
  - Created `archive/old_projects/` for historical code preservation
  - **docs/HUMOR.md** updated with "The Unprimed Expert" story (November 1, 2025)
    - Documented the 10/10 enterprise-grade Database class revelation
    - "Typical WOLFIE" moment: Built enterprise-grade from memory, asks "Is this secure?"
    - Crafty Syntax heritage: TXT file fallback (2003) → Vector DB fallback planning (2025)
    - Evidence of timeless architecture: 20-year-old code needed only syntax updates
    - Full technical and philosophical documentation of "missing trends = advantage"

- **Centralized Path Configuration System**
  - `config/paths.php` - Auto-detection using `dirname(__DIR__)`
  - `config/paths.py` - Auto-detection using `Path(__file__).parent.parent`
  - `config/paths.yaml` - Central configuration with project root
  - Auto-detection ensures paths work regardless of folder name
  - Single source of truth for all path references

- **Mobile Interface** (November 1, 2025)
  - Mobile device detection with User-Agent pattern matching
  - Automatic redirect to `/mobile/index.php` for mobile devices
  - Desktop override: `?desktop=1` parameter sets 30-day cookie
  - **mobile/index.php**: Functional mobile homepage
    - Uses shared database connection (not separate mobile DB)
    - Real stats from database (users, content, channels, collections)
    - Working links to desktop pages (content, questions, chat, collections)
    - "Switch to Desktop View" button with proper navigation
    - lupopedia.com branding, v0.0.4 version display
  - **mobile/css/mobile.css**: Touch-optimized styling
    - Full-width, touch-friendly buttons (56px minimum height)
    - Gradient backgrounds for visual hierarchy
    - 2-column stat grid on phones, 4-column on tablets
    - Responsive breakpoints: <480px, 481-767px, 768px+
    - Active states with scale animations
    - Smooth scrolling, pull-to-refresh prevention
    - Accessibility support (reduced motion, high contrast)
  - **mobile/config/database_mobile.php**: Fixed PDO connection
    - Corrected invalid `PDO::MYSQL_ATTR_CONNECT_TIMEOUT` constant
    - Uses shared `wolfie` database (not separate mobile DB)
    - Proper error handling and connection management
  - Philosophy: Separate mobile/desktop versions (not responsive design)
  - Desktop users can force mobile view, mobile users can force desktop view

- **Deployment Roadmap** (November 1, 2025)
  - Updated `DISTRIBUTION_DEPLOYMENT_GUIDE.md` with future deployment options
  - Documented "build for constraints first" philosophy
  - Roadmap for serverless platforms: Vercel, AWS Lambda, Google Cloud Functions, Azure Functions
  - Roadmap for containerization: Docker, Kubernetes
  - Phase 1 (v0.0.4): Shared hosting (CURRENT)
  - Phase 2 (v0.1.x): Cloud platforms (PLANNED)
  - Phase 3 (v0.2.x): Enterprise options (PLANNED)

### Changed

- **WOLFIE Network Page Updates** (November 1, 2025 - Late Evening)
  - Updated `public/admin/wolfie-agi-network.php` to read from `wolfie_network_peers` table (remote WOLFIE installations)
  - Changed from tracking local user sites to tracking discovered network peers
  - Updated statistics: Total Peers, Active Peers, Error Peers, Configured Beacons
  - Updated table columns: Domain, Instance Name, Beacon URL, Version, Status (ok/degraded/error/unknown), Last Seen
  - Added Status filter dropdown (OK, Degraded, Error, Unknown)
  - Updated modal to display peer metadata (version, specialization, API endpoints, timestamps, contact info)
  - Updated queries to use peer-specific fields instead of local site fields

- **Terminology Cleanup** (November 1, 2025 - Late Evening)
  - Changed "WOLFIE AGI AI" to "WOLFIE AI" in admin navigation section title
  - Updated "AGI Dashboard" to "AI Dashboard"
  - Updated "WOLFIE AGI Network" to "WOLFIE Network"
  - Updated page titles, descriptions, and comments in:
    - `public/admin.php` (navigation and CSS comments)
    - `public/admin/wolfie-agi-dashboard.php`
    - `public/admin/wolfie-agi-network.php`
    - `public/admin/task-management.php`
  - Reason: "WOLFIE AGI" implies building Artificial General Intelligence (future project), current focus is "WOLFIE" platform

- **Public Questions Page Filters** (November 1, 2025 - Evening Session)
  - Filters now display on ALL tabs (not just Q/A tab)
  - Renamed "Data Type" filter to "Status" for clarity
  - Status options: ✅ Verified, 🤖 AI Assumption, 👤 User Submitted
  - Sort options available on all tabs: Newest First, Title (A-Z), Priority, Confidence

- **Admin Navigation Reorganization** (November 1, 2025 - Evening Session)
  - Removed duplicate "Source of Truth (WHO/WHAT/WHERE/WHEN/WHY)" link (consolidated into qa-browse)
  - Removed "Q/A Root Tags" link (consolidated into qa-browse)
  - Added `case 'hacks-edit'` route handler (was missing, causing 404 errors)
  - Added `case 'sot-content-browse'` route handler
  - Added `case 'tags-browse'` route handler
  - Reorganized navigation order: TAGS ADMIN now appears before Q/A ADMIN

### Fixed

- **Database Stability Issues** (Migrations 1002-1005)
  - Fixed recurring database crashes caused by DEFINER views
  - Fixed indexes on renamed columns
  - Fixed CHECK constraints on old column names
  - Created `database/docs/DATABASE_CRASH_ANALYSIS_2025_11_01.md` for root cause analysis
  - Updated PHP code to query tables directly instead of views
  - Result: Stable database ready for production deployment

- **View Dependencies in PHP Code** (November 1, 2025)
  - Updated `public/classes/AIAnalysis.php` to query `ai_agent_analytics` table directly
  - Updated `public/admin/token-usage.php` to query `token_usage` and `users` tables
  - Updated `public/agent_profiles/ai_genesis_12.htm` documentation
  - Removed all dependencies on dropped views
  - Documentation: `database/docs/VIEW_USAGE_CLEANUP_2025_11_01.md`

- **Admin Q/A Browse Query Errors** (November 1, 2025 - Evening Session)
  - Fixed undefined `$types` variable error in non-search queries
  - Moved `$params` and `$types` initialization to before tab-specific query building
  - All tabs now properly initialize variables before use

- **Admin Content Button Links** (November 1, 2025 - Evening Session)
  - Fixed "📝 Content" button to use correct `content_questions` columns (`sot_type` and `sot_detail_id`)
  - Previously queried non-existent columns (`source_of_truth_id`, `sot_detail_type_X`)
  - Now matches public `sot_collections.php` query structure
  - Content button now appears on all tabs with tagged content

### Changed

- **TODO_FOR_NEXT_RELEASE.md** (November 1, 2025)
  - Updated version from 0.0.3 to 0.0.4
  - Documented completed tasks (template system, chat system, Q/A API, user docs)
  - Added new priorities: Mobile interface, admin testing, updated index.php
  - Mobile interface approach: Separate `/public/mobile/` directory (not responsive design)
  - Estimated ~10 tasks remaining for first release

- **Domain Name & Platform Branding** (November 1, 2025)
  - Official domain: **lupopedia.com** (selected)
  - Platform name: WOLFIE - Web Ontology Library Framework Intelligent Explorer
  - Domain etymology: Lupo (wolf) + pedia (knowledge) = "Wolf Encyclopedia"
  - Alias domains registered (all redirect to lupopedia.com)
  - Previous domain (wisdomoflovingfaith.com) remains for religious installation
  - lupopedia.com = main platform site (downloads, documentation, community)

- **Project Folder Renamed**
  - Old: `C:\WISDOM_OF_LOVING_FAITH_01`
  - New: `C:\WOLFIE_Ontology`
  - Reason: Platform evolved to domain-agnostic ontology framework
  - **37 files updated** with correct path references
    - Core documentation (README.md, DATABASE.md, CHANGELOG.md)
    - Config files (paths.yaml)
    - Planning documents (3 files)
    - Root documentation (2 files)
    - Public PHP files (17 files)
    - API files (8 files)
    - CSV data files (3 files)

- **Root Directory Organization**
  - **Before**: ~30+ markdown files cluttering root directory
  - **After**: **8 essential files only** (README.md, CHANGELOG.md, DATABASE.md, EXECUTIVE_SUMMARY_CURRENT_STATE.md, NEXT_SESSION_START_HERE.md, TODO_FOR_NEXT_RELEASE.md, WHO_IS_WOLFIE.md, AGAPE_CONTEXTUAL.yaml)
  - **31 files moved** to organized subdirectories
  - **5 folders archived** (salessyntax-3.7.0, src, review_files, spiritual_figures, env_secret_remote.txt)
  - Professional, clean project structure

- **Documentation Structure Reorganized**
  - Status reports moved to `docs/status/`
  - Organization plans moved to `docs/organization/`
  - Planning documents consolidated in `docs/planning/`
  - Protocol documents organized in `docs/protocols/`
  - Guides organized in `docs/guides/`
  - Session logs in `docs/sessions/`
  - Database docs in `database/docs/`
  - Old projects preserved in `archive/old_projects/`

- **Distribution Structure Clarified**
  - Documented that `public` folder IS the web root
  - Correct URL: `http://yourdomain.com/WOLFIE_Ontology/`
  - NOT: `http://yourdomain.com/WOLFIE_Ontology/public/`
  - 4 deployment scenarios documented
  - Installation steps clarified

- **Database Counts**: 152 tables (down from 165) - 103 remaining capacity toward 255-table limit
- **README.md**: Updated database counts, version numbers, workspace path, user guide reference
- **DATABASE.md**: Documented migrations 1002-1005, updated table list to match `SHOW TABLES` output
- **TODO_FOR_NEXT_RELEASE.md**: Updated to v0.0.4, documented completed tasks, added mobile/admin/index.php priorities
- **FUTURE_FEATURES_FOR_LATER_RELEASES.md** (November 1, 2025 - Evening Session):
  - Added "Q/A & SOT Item Editing Interface" section (Priority: High, v0.0.5+)
  - Added "Content Tagging UI in Content-Edit" section (Priority: High, v0.0.5+)
  - Documented need for Q/A edit pages (qa-edit.php, sot-who-edit.php, etc.)
  - Documented need for tag attachment UI in content-edit.php with AJAX search
- **Session Documentation**: Created comprehensive session summaries in `docs/status/`

### Removed

- **Resource Management Section** (November 1, 2025 - Late Evening)
  - Removed "Resource Management" section and all links from admin navigation
  - Removed "Manage Resources" link
  - Removed "Link Resources" link
  - Removed "View Public Page" link
  - Replaced with "File Management" section

- **Correlations Section** (November 1, 2025 - Late Evening)
  - Removed "Correlations ⭐" section and all links from admin navigation
  - Removed "Correlations Admin" (`admin.php?section=correlations`)
  - Removed "Moderation Queue" (`admin.php?section=correlation-moderation`)
  - Removed "AI Suggestions" (`admin.php?section=ai-suggestions`)
  - Removed corresponding route handlers from switch statement
  - Reason: Features not implemented; admin cleanup for release

- **Database Cleanup for Packaged Release** (Migrations 1002-1005)
  - **Migration 1002**: Dropped all database views (7 views) causing DEFINER permission issues
    - Dropped `vw_ai_channel_activity`, `vw_channel_participant_stats`, `vw_channel_system_status`, `vw_public_chat_summaries`, `vw_reaction_counts`, `vw_user_analytics`, `vw_user_chat_summaries`
    - All data still accessible via base tables
    - Improved compatibility for shared hosting installations
  - **Migration 1003**: Dropped duplicate emotional/telemetry columns from 8 tables
    - Removed `ara_emotional_state`, `ara_telemetry_data`, `wolfie_emotional_state`, `wolfie_telemetry_data` from tables other than `agent_status`
    - Consolidated into `agent_status` table as single source of truth
  - **Migration 1004**: Dropped 7 ML-related tables (not currently used)
    - Dropped `ml_models`, `model_deployments`, `training_pipelines`, `hyperparameter_configs`, `ml_training_datasets`, `ml_agent_config`, `model_training_data`
    - Created during planning phase but not implemented
    - Philosophy: Build what you need, when you need it
  - **Migration 1005**: Dropped 13 planning tables (features not yet implemented)
    - Dropped workflow tables: `workflow_changes`, `workflow_evaluations`, `workflow_iterations`, `workflow_questions`
    - Dropped validation tables: `curation_training_data`, `header_validation_rules`, `header_validation_metrics`
    - Dropped health tables: `system_health_dashboard`, `system_health_monitor`, `system_health_monitoring`, `system_optimization_log`, `resource_utilization_logs`
    - Dropped config table: `neural_network_configs` (using simpler agent config)
    - Cleaned seed data for dropped tables
  - **Total Reduction**: 165 → 152 tables (-13 tables, -7.9%)
  - **Current State**: Database focused on implemented features only, ready for packaged release

- **Root Directory Clutter**
  - Removed 31 markdown files from root (moved to organized subdirectories)
  - Archived old projects (salessyntax-3.7.0, src)
  - Archived review and spiritual files
  - Professional root directory maintained (8 essential files only)

---

## [0.0.3] - 2025-11-01 - Pre-Alpha Release

**Project Name:** WOLFIE: Web Ontology Library Framework Intelligent Explorer  
**Release Type:** Pre-Alpha  
**Fork From:** WOLFIE: Wisdom Of Loving FAITH v0.0.2

### Added
- **Installation Wizard** (`public/setup.php`)
  - 6-step web-based installer (Crafty Syntax pattern)
  - Pre-installation checks (PHP version, PDO, file permissions)
  - Database configuration with connection testing
  - Admin account creation (user.id=7, username "CAPTAIN")
  - Site configuration (URL, title, description, timezone, language)
  - Database schema import from `database/schema/create_seed_all.sql`
  - Configuration file generation (`config/database.php`, `config/config.php`)
  - Security warnings for writable config files post-installation
  - Manual installation instructions (`INSTALL.txt`)

- **WOLFIE Network REST API**
  - Beacon endpoint (`/WOLFIE_NETWORK/API/`) for network discovery
  - Site status endpoint (`/WOLFIE_NETWORK/API/status`) for health checks
  - Network discovery endpoint (`/WOLFIE_NETWORK/API/discover`) for site listing
  - Read-only enforcement until version 1.0.0
  - Site information includes: name, URL, version, capabilities, statistics

- **Content API Endpoints** (`/api/`)
  - `GET /api/content` - List content items with filtering and pagination
  - `GET /api/content/{id}` - Get specific content item
  - `GET /api/tags` - List tags with filtering and pagination
  - `GET /api/tags/{id}` - Get specific tag
  - `GET /api/channels` - List channels with filtering and pagination
  - `GET /api/channels/{id}` - Get specific channel
  - `GET /api/collections` - List collections with filtering and pagination
  - `GET /api/collections/{id}` - Get specific collection
  - All endpoints support filtering, searching, sorting, and pagination

- **API Authentication System**
  - API key generation with `wolfie_` prefix
  - Secure API key hashing using `password_hash()`
  - API key validation and rate limiting (default 1000 requests/hour)
  - Request logging to `api_request_logs` table
  - API key management endpoint (`/api/manage_keys.php`) for admin users
  - Database tables: `api_keys`, `api_request_logs` (Migration 999)
  - Multiple authentication methods: Bearer token, X-API-Key header, query parameter

- **API Documentation**
  - Comprehensive API documentation (`public/docs/API_DOCUMENTATION.md`)
  - Endpoint reference with examples (cURL, JavaScript, PHP)
  - Authentication guide
  - Rate limiting documentation
  - Error code reference

- **Database Connection Testing**
  - Simple test utility (`public/test_database_connect.php`)
  - Connection validation with detailed diagnostics
  - Table existence verification

- **3-Level Nested Menu System** for TAGS tab
  - Root tags → Child tags → Items hierarchical navigation
  - Parent menus remain open when opening nested submenus
  - Improved menu positioning using DOM hierarchy before content movement
  - Enhanced submenu tracking with `data-source-id` attributes

- **Saved Collections Navigation**
  - TAGS tab navigation (blue) with 3-level nested structure
  - WHO/WHAT/WHERE/WHEN/WHY/HOW/DO tabs (green) with 2-level structure
  - Tab ordering: TAGS first, followed by Q/A tabs
  - Collection count badges on each tab
  - Save/Load/Edit collection functionality buttons

- **Database Column Standardization**
  - Renamed `ara_emotional_state` → `wolfie_emotional_state` across all tables
  - Renamed `ara_telemetry_data` → `wolfie_telemetry_data` across all tables
  - Standardized timestamp columns to `updated_at` naming convention
  - Fixed enum definitions to include 'other' value for better flexibility

- **Template System** (Migration 620)
  - Created template management tables (`templates`, `template_content`, `template_system`)
  - Template class (`public/classes/Template.php`) for template loading, rendering, and inheritance
  - Seed data for template system (`database/seed_data/seed_templates.sql`)
  - Template inheritance system (child templates inherit from parent templates)
  - Template variable substitution system (`{page_title}`, `{content_table}`, `{pagination}`, etc.)
  - Template sections: header, body, footer, styles, scripts, sidebar, metadata
  - Default templates: `default_scroll` (ID 1), `default_events` (ID 3), `default_content` (ID 4), `default_topics` (ID 5), `default_files` (ID 6), `default_users` (ID 7), `default_collections` (ID 8)
  - **Pages converted to use templates:**
    - ✅ `events.php` - Uses `default_events` template (inherits from default_scroll)
    - ✅ `topics.php` - Uses `default_topics` template (inherits from default_scroll)
    - ✅ `channels.php` - Uses scroll template
    - ✅ `files.php` - Uses `default_files` template (inherits from default_scroll)
    - ✅ `users.php` - Uses `default_users` template (inherits from default_scroll)
    - ✅ `browse_collections.php` - Uses `default_collections` template (inherits from default_scroll)
    - ✅ `agents.php` - Uses scroll template or agent page template
    - ✅ `agent_profile.php` - Uses scroll template or agent page template
    - ✅ `content.php` - Uses `default_content` template (inherits from default_scroll)
    - ✅ `questions.php` - Uses `default_scroll` template
    - ✅ `sot_collections.php` - Uses `default_scroll` template
  - Template system documentation in `DATABASE.md` (Step 9 complete)

- **Improved Menu System**
  - Sibling-only cleanup logic using `:scope >` selector
  - Automatic ancestor protection (non-sibling menus stay open)
  - Better handling of cloned submenu content in document.body
  - Enhanced click-outside and Escape key cleanup handlers

- **Spacer Div** for saved collections navigation area
  - 50px × 40px white background spacer before navigation bar

### Changed
- **Project Rebranding** (October 30, 2025)
  - WOLFIE acronym changed from "Wisdom Of Loving FAITH" to "Web Ontology Library Framework Intelligent Explorer"
  - Updated all documentation and public-facing references
  - Platform focus shifted from religious-specific to domain-agnostic ontology framework

- **Tab Order** - TAGS tab now appears first in saved collections container
- **Menu Closing Logic** - Simplified to only close siblings, automatically protecting ancestors
- **Submenu Positioning** - Uses DOM container relationships before content cloning
- **Cleanup Handlers** - Unified cleanup logic for both click-outside and Escape key events
- **Template System Implementation** (November 1, 2025 Session)
  - Converted 11 pages to use template system (events, topics, channels, files, users, browse_collections, agents, agent_profile, content, questions, sot_collections)
  - Standardized page display using template inheritance (most pages inherit from default_scroll)
  - Removed duplicate border structures (collections-* divs) to prevent template conflicts
  - Template system documentation added to `DATABASE.md`

### Fixed
- Fixed third-level menu appearing at top-left (0,0) position
- Fixed secondary menu closing when opening third-level menu in TAGS tab
- Fixed menu positioning relative to clicked trigger element
- Fixed orphaned submenu content cleanup in document.body
- Fixed data truncation warnings for `agent_type` and `ara_emotional_state` enums
- Fixed SQL syntax errors in CHECK constraint definitions
- Fixed SQL parser in installer to handle complex SQL dumps with quoted strings and semicolons
- Fixed `INSTALL.txt` to clarify that only `config/database.php` needs `chmod 777` temporarily
- Fixed security check in `index.php` to warn if config files remain writable after installation
- Fixed duplicate border structures in `sot_collections.php` (removed collections-* divs overlapping with template borders)
- Fixed `mb_substr()` undefined function error in `questions.php` (added fallback to `substr()` when mbstring extension not available)
- Fixed hardcoded database connections in `content.php` and `login.php` (replaced with centralized `getDatabaseConnection()`)
- Fixed template not showing in `questions.php` (replaced with `questions_new.php` implementation)

### Removed
- Removed unused tables: `ara_autonomous_actions`, `a_b_testing_configs`, `cache_management`, `coordination_channels`, `correlation_network`, `ai_recommendations`, `content_versions`, `agent_behavior_patterns`
- Cleaned up obsolete code references to legacy columns

---

## [0.0.2] - 2025-10-30 - Pre-Release

**Project Name:** WOLFIE: Wisdom Of Loving FAITH (Wisdom Of Loving Faith, Integrity, and Ethics)  
**Release Type:** Pre-Release  
**Fork From:** AGAPE CONTEXTUAL HEADERS v0.0.1  
**Note:** This version was rebranded to "Web Ontology Library Framework Intelligent Explorer" on October 30, 2025, leading to v0.0.3

### Project Evolution
- Evolved from AGAPE contextual headers system to full spiritual platform
- Added comparative analysis of verses, songs, and prayers across religious traditions
- Integrated AI-powered correlations and human insights
- Implemented codex books with comparative religious concepts

### Key Features
- Multi-faith content comparison system
- AI and human annotation system
- Collection management system
- Recently viewed tracking
- Q/A (Who/What/Where/When/Why/How/Do) content organization
- Tags system with hierarchical structure

### Major Accomplishments (October 30, 2025 Session)
- **Q/A Tagging System**: Complete hierarchical tagging with tree navigation
  - Added `qa_identifier`, `parent_id`, `sort_order` to all `sot_*` tables
  - Content-to-Q/A linking via `content_questions` table
  - Content Headers Q/A linking via `sot_type` and `sot_id` columns
  
- **Database Schema Enhancements**
  - Dropped legacy tables: `religions`, `content_books`, `content_context`
  - Migrated religion references to unified `content` table
  - Added orphan enforcement policy (id=1 defaults, ON DELETE RESTRICT)
  - Created events tables (`events`, `event_exceptions`, `event_attachments`)
  
- **Admin Interface Refactoring**
  - Removed old Content Management sections
  - Added new Content Management: Content Items, Content Q/A Tags, Content Headers
  - Created admin pages: `content-browse.php`, `content-edit.php`, `content-questions.php`
  
- **Public Interface Updates**
  - Added "Question Tags" section to `content.php`
  - Enhanced `questions.php` with tree view navigation
  - Updated all public files with new WOLFIE acronym

- **AI Agent System Updates**
  - Replaced `zarathustra_approved` with multi-agent approval system
  - Added `wolfie_approved`, `vishwakarma_approved`, `needs_review` columns
  - Renamed core agent to AGAPE

---

## [0.0.1] - 2025-10-01 - Pre-Release

**Project Name:** AGAPE CONTEXTUAL HEADERS  
**Release Type:** Pre-Release

### Initial Release
- Contextual headers system
- Superpositionally Headers V2.1.0 format
- AI agent metadata and context tracking
- Protocol enforcement system
- Foundation for future WOLFIE iterations

---

## Version History Notes

### Project Lineage
1. **v0.0.1** - AGAPE CONTEXTUAL HEADERS
   - Foundation system for contextual metadata
   - Protocol-based architecture

2. **v0.0.2** - WOLFIE: Wisdom Of Loving FAITH (Fork from v0.0.1)
   - Spiritual platform expansion
   - Multi-faith content system
   - Q/A content organization

3. **v0.0.3** - WOLFIE: Web Ontology Library Framework Intelligent Explorer (Fork from v0.0.2)
   - Ontology framework focus
   - Enhanced navigation and menu systems
   - Improved user interface and interaction patterns

### Future Releases

**Planned for Future Versions:**
- Full alpha release with complete ontology framework
- Beta release with extended features
- Production-ready release (v1.0.0)

---

## Legend

- **Added** - New features
- **Changed** - Changes to existing functionality
- **Deprecated** - Features that will be removed in upcoming releases
- **Removed** - Removed features
- **Fixed** - Bug fixes
- **Security** - Security vulnerability fixes

---

**Project Repository:** WOLFIE_Ontology  
**License:** GPL v3 and Apache 2.0 (Dual Licensed)  
**Maintainer:** Captain WOLFIE (Eric Robin Gerdes)

