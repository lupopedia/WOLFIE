---
title: WOLFIE_HEADER_SYSTEM.md
agent_username: wolfie
date_created: 2025-11-03
last_modified: 2025-11-03
status: published
onchannel: 1
tags: [SYSTEM, DOCUMENTATION]
collections: [WHAT, HOW]
in_this_file_we_have: [OVERVIEW, HOW_IT_WORKS, EXAMPLE, BENEFITS, FOLDER_STRUCTURE]
---

---

# WOLFIE Header System Documentation

## OVERVIEW

The WOLFIE header system replaces the old AGAPE_CONTEXTUAL_HEADER_BEGIN/END system with a much simpler, centralized approach that eliminates duplication across 11,000+ files.

**Old System Problems:**
- 25+ lines per file with duplicated information
- System-wide info (like version) repeated in every file
- Hard to update - changing one thing requires touching all files
- Bloated headers that obscure actual content

**New System Benefits:**
- Only 4-7 lines per header
- References central "source of truth" files
- One place to update system-wide information
- Clean, readable headers that get straight to the point

---

## HOW_IT_WORKS

### 1. Every MD file starts with:
```markdown
#filename.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SYSTEM", "DATABASE"]
- **COLLECTIONS**: ["WHO", "WHAT"] 
- **in_this_file_we_have**: ["OVERVIEW", "SETUP", "EXAMPLES"] 
## WOLFIE_END
```

### 2. The **onchannel** number tells you which folder to read:
- `onchannel: 1` → Read from `md_files/1_wolfie/`
- `onchannel: 2` → Read from `md_files/2_database/`
- `onchannel: 238` → Read from `md_files/238_spiritual/`

### 3. Look up TAGS in the channel's TAGS.md:
File says `TAGS: ["SYSTEM"]` → Read `md_files/1_wolfie/TAGS.md` → Find `##SYSTEM` section

### 4. Look up COLLECTIONS in the channel's COLLECTIONS.md:
File says `COLLECTIONS: ["WHO"]` → Read `md_files/1_wolfie/COLLECTIONS.md` → Find `##WHO` section

### 5. Use **in_this_file_we_have** as a quick table of contents:
Shows what major sections exist in the file without reading the whole thing

---

## EXAMPLE

### File: database/README.md
```markdown
#README.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["DATABASE"]
- **COLLECTIONS**: ["WHAT", "WHERE"] 
- **in_this_file_we_have**: ["SCHEMA", "MIGRATIONS", "MAINTENANCE"] 
## WOLFIE_END

... rest of file content ...
```

### AI Reading Process:
1. **Sees onchannel: 1** → Open `md_files/1_wolfie/TAGS.md` and `COLLECTIONS.md`
2. **Sees TAGS: ["DATABASE"]** → In TAGS.md, read ##DATABASE section:
   - Gets: 152 tables, HEALTHY status, meaning, usage
3. **Sees COLLECTIONS: ["WHAT", "WHERE"]** → In COLLECTIONS.md, read ##WHAT and ##WHERE:
   - Gets: Project description, workspace path, database location
4. **Sees in_this_file_we_have** → Knows file contains schema, migrations, and maintenance docs
5. **Total info gathered:** Full context in seconds without reading entire file

---

## BENEFITS

✅ **No Duplication** - Version, user info, system status defined once  
✅ **Easy Updates** - Change TAGS.md once, affects all files referencing it  
✅ **Scalable** - Works with 10 files or 100,000 files  
✅ **Fast** - AI reads 2 small reference files instead of 25 lines × 11,000 files  
✅ **Clean** - Headers are 4-7 lines instead of 25+ lines  
✅ **Flexible** - Add new tags/collections without touching existing files  

---

## FOLDER_STRUCTURE

```
md_files/
├── WOLFIE_HEADER_SYSTEM.md (this file)
├── CHANNELS.md (coming soon - master channel index)
├── 1_wolfie/
│   ├── TAGS.md (defines SYSTEM, DATABASE, DOCUMENTATION, SESSION tags)
│   └── COLLECTIONS.md (defines WHO, WHAT, WHERE, WHEN, WHY, HOW)
├── 2_database/ (future)
│   ├── TAGS.md
│   └── COLLECTIONS.md
└── 238_spiritual/ (future)
    ├── TAGS.md
    └── COLLECTIONS.md
```

### Folder Naming Convention:
- Format: `{channel_number}_{channel_name}/`
- Examples: `1_wolfie/`, `2_database/`, `238_spiritual/`
- Channel 1 is the **base/default channel** - all files default to channel 1 unless specified

---

## MIGRATION_NOTES

**Status:** System created 2025-11-03, currently testing  
**Migration:** NO mass migration yet - testing for bugs first  
**Old System:** AGAPE_CONTEXTUAL_HEADER_BEGIN/END still exists in files  
**Timeline:** Once bugs are worked out, we'll create migration script

---

**Created:** 2025-11-03  
**Last Updated:** 2025-11-03  
**Status:** ✅ Active System (Testing Phase)

