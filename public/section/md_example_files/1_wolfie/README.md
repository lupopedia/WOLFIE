---
title: README.md
agent_username: wolfie
date_created: 2025-11-03
last_modified: 2025-11-03
status: published
onchannel: 1
tags: [SYSTEM]
collections: [WHAT, HOW]
in_this_file_we_have: [CHANNEL_OVERVIEW, CHANNEL_FILES, AVAILABLE_TAGS, AVAILABLE_COLLECTIONS, USAGE_EXAMPLES]
---

---

# Channel 1: Wolfie Base Channel

## CHANNEL_OVERVIEW

**Channel 1** is the **base/default channel** for the WOLFIE system. This channel contains core system definitions, tags, and collections that apply to general WOLFIE functionality.

### Purpose:
- Provide base-level tags and collections for system-wide use
- Act as the default channel when no specific channel is specified
- Define core system information (version, user, project details)

### When to Use Channel 1:
- ✅ General documentation that doesn't fit a specialized channel
- ✅ System-wide reference files
- ✅ When you're not sure which channel to use
- ✅ Core WOLFIE functionality documentation

### When NOT to Use Channel 1:
- ❌ Database-specific content (use channel 2)
- ❌ Spiritual/religious content (use channel 238)
- ❌ Highly specialized content with its own channel

---

## CHANNEL_FILES

### Required Files (Source of Truth):
- **`TAGS.md`** - Defines all available tags for this channel
- **`COLLECTIONS.md`** - Defines all available collections for this channel

### Documentation Files:
- **`README.md`** (this file) - Channel 1 documentation

---

## AVAILABLE_TAGS

Current tags defined in `TAGS.md`:

### SYSTEM
Core system documentation, configuration, and architecture files.
- Version: 0.0.6 (Development)
- Use for: System-level documentation

### DATABASE
Database schema, migrations, and data management.
- Status: 152 tables, HEALTHY
- Use for: Database-related documentation

### DOCUMENTATION
User guides, API docs, and reference materials.
- Use for: End-user and developer documentation

### SESSION
Session logs, summaries, and progress tracking.
- Use for: Daily work logs and session tracking

**See `TAGS.md` for complete definitions and details.**

---

## AVAILABLE_COLLECTIONS

Current collections defined in `COLLECTIONS.md`:

### WHO
People, agents, and entities involved in the project.
- Captain WOLFIE, AI assistants, project identity

### WHAT
Project description, features, and capabilities.
- WOLFIE platform description and purpose

### WHERE
Locations, paths, and system topology.
- Workspace paths, database locations, file paths

### WHEN
Timestamps, schedules, and timeline information.
- Creation dates, update times, phase information

### WHY
Purpose, motivation, and strategic reasoning.
- Strategic goals, mission, vision

### HOW
Technical implementation and methodologies.
- Architecture, AI agents, channel system

**See `COLLECTIONS.md` for complete definitions and details.**

---

## USAGE_EXAMPLES

### Example 1: System Documentation File
```markdown
#system_architecture.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SYSTEM"]
- **COLLECTIONS**: ["WHAT", "HOW"] 
- **in_this_file_we_have**: ["ARCHITECTURE", "COMPONENTS", "DESIGN"] 
## WOLFIE_END

# System Architecture
...content...
```

### Example 2: Session Log
```markdown
#2025-11-03_session.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SESSION"]
- **COLLECTIONS**: ["WHEN", "WHAT"] 
- **in_this_file_we_have**: ["TASKS_COMPLETED", "DECISIONS_MADE", "NEXT_STEPS"] 
## WOLFIE_END

# Session Log 2025-11-03
...content...
```

### Example 3: Database Documentation
```markdown
#database_guide.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["DATABASE", "DOCUMENTATION"]
- **COLLECTIONS**: ["WHAT", "HOW", "WHERE"] 
- **in_this_file_we_have**: ["SCHEMA", "TABLES", "QUERIES", "EXAMPLES"] 
## WOLFIE_END

# Database Guide
...content...
```

---

## HOW_AI_READS_THIS

When an AI sees a file with `onchannel: 1`:

1. **Opens** `md_files/1_wolfie/TAGS.md`
2. **Opens** `md_files/1_wolfie/COLLECTIONS.md`
3. **Looks up** each tag in `TAGS: ["SYSTEM", "DATABASE"]` in TAGS.md
4. **Looks up** each collection in `COLLECTIONS: ["WHO", "WHAT"]` in COLLECTIONS.md
5. **Gets full context** from these central definition files
6. **Uses** `in_this_file_we_have` to understand file structure

### Benefits:
- ✅ AI gets complete context in seconds
- ✅ No duplicated information to maintain
- ✅ One place to update system-wide info
- ✅ Consistent definitions across all files

---

## ADDING_NEW_TAGS_OR_COLLECTIONS

### To Add a New TAG:
1. Open `TAGS.md`
2. Add a new `##TAG_NAME` section
3. Include: Meaning, Usage, and any relevant details
4. Save and document in this README

### To Add a New COLLECTION:
1. Open `COLLECTIONS.md`
2. Add a new `##COLLECTION_NAME` section
3. Include: Meaning, Content, and any relevant details
4. Save and document in this README

### Guidelines:
- Keep tags broad enough to be reusable
- Make collections specific enough to be meaningful
- Document clearly what each tag/collection represents
- Update this README when adding new tags/collections

---

**Channel**: 1 (wolfie - base/default)  
**Created**: 2025-11-03  
**Last Updated**: 2025-11-03  
**Status**: ✅ Active  
**Maintainer**: Captain WOLFIE

