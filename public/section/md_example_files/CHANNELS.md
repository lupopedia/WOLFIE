---
title: CHANNELS.md
agent_username: wolfie
date_created: 2025-11-03
last_modified: 2025-11-03
status: published
onchannel: 1
tags: [SYSTEM]
collections: [WHAT]
in_this_file_we_have: [CHANNEL_INDEX, NAMING_RULES, ADDING_CHANNELS]
---

---

# Channel Directory

This file is the **master index** of all channels in the WOLFIE system.

---

## CHANNEL_INDEX

### Active Channels

| Channel | Folder | Purpose | Status |
|---------|--------|---------|--------|
| **1** | `1_wolfie/` | Base/system channel - core WOLFIE functionality | ✅ Active |
| **2** | `2_database/` | Database schemas, migrations, and data management | 🚧 Planned |
| **238** | `238_spiritual/` | Spiritual content and interfaith analysis | 🚧 Planned |

### Legacy/Numbered Folders (Pre-Channel System)

These folders exist but need to be migrated to the channel system:

| Folder | Purpose | Migration Status |
|--------|---------|-----------------|
| `02_organization/` | Organization and planning docs | 📋 Needs Review |
| `03_system_status/` | System status tracking | 📋 Needs Review |
| `04_integration/` | Integration documentation | 📋 Needs Review |
| `05_technical/` | Technical documentation | 📋 Needs Review |
| `06_collections/` | Collections system docs | 📋 Needs Review |
| `07_sessions/` | Session logs and summaries | 📋 Needs Review |
| `08_analysis/` | Analysis and reports | 📋 Needs Review |
| `09_migrations/` | Migration documentation | 📋 Needs Review |
| `222_core_agi/` | Core AGI documentation | 📋 Needs Review |

---

## NAMING_RULES

### Channel Folder Format
```
{channel_number}_{channel_name}/
```

**Examples:**
- `1_wolfie/` - Channel 1, wolfie
- `2_database/` - Channel 2, database
- `238_spiritual/` - Channel 238, spiritual

### Required Files per Channel
Each channel folder **must** contain:
- `TAGS.md` - Defines all tags available on this channel
- `COLLECTIONS.md` - Defines all collections available on this channel

### Optional Files per Channel
- `README.md` - Channel overview and documentation
- `EXAMPLES.md` - Example files using this channel's tags/collections

---

## ADDING_CHANNELS

### To Create a New Channel:

1. **Pick a channel number** (check existing channels first)
2. **Create folder:** `md_files/{number}_{name}/`
3. **Create TAGS.md:**
   ```markdown
   #TAGS.md
   #
   # This file defines all available TAGS for channel {number}
   #
   
   ##TAG_NAME
   - **Meaning**: What this tag means
   - **Usage**: When to use this tag
   ```

4. **Create COLLECTIONS.md:**
   ```markdown
   #COLLECTIONS.md
   #
   # This file defines all available COLLECTIONS for channel {number}
   #
   
   ##COLLECTION_NAME
   - **Meaning**: What this collection represents
   - **Content**: What information it contains
   ```

5. **Update this file** (CHANNELS.md) with the new channel info

---

## CHANNEL_PHILOSOPHY

- **Channel 1** is the **base/default channel** - when in doubt, use channel 1
- Channels group related tags and collections together
- Each channel should have a clear, distinct purpose
- Don't create new channels unless there's a good reason
- Most files will live on channel 1

---

**Created:** 2025-11-03  
**Last Updated:** 2025-11-03  
**Status:** ✅ Active Reference

