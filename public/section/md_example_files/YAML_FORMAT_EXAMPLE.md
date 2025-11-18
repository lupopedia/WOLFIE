---
title: YAML Format Example
agent_username: wolfie
date_created: 2025-11-03
last_modified: 2025-11-03
status: published
onchannel: 1
tags: [SYSTEM, DOCUMENTATION, EXAMPLE]
collections: [WHAT, HOW]
in_this_file_we_have: [INTRODUCTION, YAML_BENEFITS, FORMAT_COMPARISON, USAGE_GUIDE]
---

# YAML Format Example

This file demonstrates the new YAML frontmatter format for WOLFIE headers.

## INTRODUCTION

The WOLFIE Header System has been upgraded to use standard YAML frontmatter instead of custom `WOLFIE_BEGIN/END` markers. This provides better compatibility with existing tools while maintaining all of WOLFIE's innovative features.

## YAML_BENEFITS

### Why YAML Frontmatter?

**Standards Compliance:**
- GitHub renders YAML frontmatter automatically
- VSCode extensions recognize it
- Compatible with Jekyll, Hugo, Docusaurus, Obsidian
- Industry-standard format used by millions

**Still Keeps WOLFIE Innovations:**
- Source of truth (TAGS.md, COLLECTIONS.md)
- Channel architecture
- `in_this_file_we_have` for programmatic TOC
- Zero dependencies (simple parser included)

**Better Than Modern Systems:**
- Standard format ✅
- Centralized definitions ✅ (they don't have this)
- Channel awareness ✅ (they don't have this)
- Simple, no build tools ✅

## FORMAT_COMPARISON

### Old Format (Custom):
```markdown
#README.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SYSTEM", "DOCUMENTATION"]
- **COLLECTIONS**: ["WHO", "WHAT"]
- **in_this_file_we_have**: ["INTRO", "SETUP"]
## WOLFIE_END

# Content starts here
```

### New Format (YAML):
```markdown
---
title: README.md
onchannel: 1
tags: [SYSTEM, DOCUMENTATION]
collections: [WHO, WHAT]
in_this_file_we_have: [INTRO, SETUP]
---

# Content starts here
```

**Differences:**
- Cleaner syntax (no bullet points, asterisks)
- Standard format recognized by tools
- Optional fields easier to add
- GitHub displays it nicely
- Same functionality, better format

## USAGE_GUIDE

### How to Write YAML Frontmatter

**Required Format:**
```yaml
---
title: Your File Name
onchannel: 1
tags: [TAG1, TAG2, TAG3]
collections: [COL1, COL2]
in_this_file_we_have: [SECTION1, SECTION2]
---
```

**Rules:**
1. Must start and end with `---` (three dashes)
2. Arrays use bracket notation: `[item1, item2, item3]`
3. Strings can be with or without quotes
4. Field names are lowercase
5. No bullet points or special formatting

**Click on tags/collections above to see their definitions!**

The source of truth system still works - definitions are in:
- `md_files/1_wolfie/TAGS.md`
- `md_files/1_wolfie/COLLECTIONS.md`

This is the **best of both worlds**: standard format + innovative centralized definitions.

---

**Created by Captain WOLFIE using The WOLFIE Way**

