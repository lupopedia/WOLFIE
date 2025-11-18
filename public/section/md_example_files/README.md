---
title: WOLFIE Header System - YAML Frontmatter Edition
agent_username: wolfie
date_created: 2025-11-03
last_modified: 2025-11-03
status: published
onchannel: 1
tags: [SYSTEM, DOCUMENTATION]
collections: [WHO, WHAT, WHERE, WHEN, WHY, HOW]
in_this_file_we_have: [OVERVIEW, YAML_FORMAT, SOURCE_OF_TRUTH, CHANNEL_SYSTEM, BENEFITS, QUICK_START]
---

# WOLFIE Header System - YAML Frontmatter Edition

**WHO**: Captain WOLFIE (Eric Robin Gerdes)  
**WHAT**: Documentation system using YAML frontmatter with centralized definitions  
**WHEN**: November 3, 2025  
**WHY**: Combine standard formats with innovative organizational concepts  

---

## OVERVIEW

The WOLFIE Header System is a **markdown documentation system** that combines:

1. **Standard YAML frontmatter** (like Jekyll, Hugo, Docusaurus)
2. **Centralized definitions** (TAGS.md, COLLECTIONS.md as source of truth)
3. **Channel architecture** (multi-context documentation)
4. **Programmatic TOC** (`in_this_file_we_have` field)

**Result**: Standard format + innovative concepts = Better than modern systems

---

## YAML_FORMAT

### What is YAML Frontmatter?

Industry-standard format used by:
- GitHub (renders it automatically)
- Jekyll (static site generator)
- Hugo (documentation platform)
- Obsidian (knowledge base)
- Docusaurus (documentation platform)

### How to Write It

```yaml
---
title: Your Document Title
onchannel: 1
tags: [SYSTEM, DOCUMENTATION, DATABASE]
collections: [WHO, WHAT, HOW]
in_this_file_we_have: [SECTION1, SECTION2, SECTION3]
---

# Your content starts here
```

**Rules:**
- Start and end with `---` (three dashes)
- Use `key: value` format
- Arrays use brackets: `[item1, item2, item3]`
- Must be at the very start of the file

---

## SOURCE_OF_TRUTH

### The Innovation: Centralized Definitions

**Problem**: Most documentation systems make you repeat definitions everywhere.

**WOLFIE Solution**: Define once, reference everywhere.

**Example:**

**File:** `md_files/1_wolfie/TAGS.md`
```markdown
## SYSTEM
Platform-level code and infrastructure. Includes core services, 
configuration, deployment, and foundational components.

## DATABASE
Database schemas, migrations, queries, and data management.
```

**Your File:**
```yaml
---
tags: [SYSTEM, DATABASE]
---
```

Click on "SYSTEM" or "DATABASE" → viewer shows full definition from TAGS.md

**Benefits:**
- ✅ Zero duplication
- ✅ One place to update
- ✅ Always consistent
- ✅ Modern systems DON'T have this

---

## CHANNEL_SYSTEM

### Multi-Context Documentation

**onchannel**: Specifies which context/channel this file belongs to.

**Folders:**
- `1_wolfie/` - Base channel (default)
- `2_wolfie/` - Alternative context
- `238_wolfie/` - Specialized channel

**Why?**
For ontology systems where the same concept has different meanings in different contexts:
- "Programming" in Tech context: Writing code for computers
- "Programming" in Media context: Broadcast scheduling

**Each channel has its own:**
- `TAGS.md` - Tag definitions for that channel
- `COLLECTIONS.md` - Collection definitions for that channel
- `README.md` - Channel documentation

---

## BENEFITS

### Compared to Modern Systems

**vs Jekyll/Hugo/Docusaurus:**
- ✅ Same YAML format (compatible)
- ✅ Centralized definitions (they don't have this)
- ✅ Channel architecture (they don't have this)
- ✅ No build step required (simpler)

**vs Obsidian/Roam:**
- ✅ Standard format (more portable)
- ✅ No vendor lock-in
- ✅ Works in any text editor
- ✅ Channel-aware organization

**The WOLFIE Advantage:**
```
Standard Format + Centralized Definitions + Channel Architecture
= Better than existing systems
```

---

## QUICK_START

### 1. Create Your MD File

```yaml
---
title: My Document
onchannel: 1
tags: [SYSTEM]
collections: [WHO, WHAT]
in_this_file_we_have: [INTRO, GUIDE, EXAMPLES]
---

# My Document

Content here...
```

### 2. View in WOLFIE Viewer

Visit: `public/WOLFIE/index.php?file=your_file.md`

**Features:**
- ✅ Parses YAML frontmatter
- ✅ Shows clickable tags/collections
- ✅ Generates table of contents
- ✅ Creates anchor links
- ✅ Full-text search

### 3. Click Tags/Collections

Click any tag → see definition from TAGS.md  
Click any collection → see definition from COLLECTIONS.md

### 4. Search Across Files

Use search box → finds content in all MD files  
Results link to exact file + section

---

## File Organization

```
md_example_files/
├── 1_wolfie/
│   ├── TAGS.md           ← Tag definitions for channel 1
│   ├── COLLECTIONS.md    ← Collection definitions for channel 1
│   └── README.md
├── 2_wolfie/             ← Another channel (if needed)
│   ├── TAGS.md
│   └── COLLECTIONS.md
├── README.md             ← This file
└── other_docs.md
```

---

## Philosophy: The WOLFIE Way

**From Captain WOLFIE:**

> "I build wheels myself because I built the wheels before. But I'm not stubborn - 
> when there's a standard that works, I use it. YAML frontmatter is standard.
> Centralized definitions and channel architecture are innovations.
> Best of both worlds."

**The Result:**
- Standard format (not on an island)
- Innovative concepts (better than alternatives)
- Zero dependencies (keep it simple)
- Battle-tested patterns (Crafty Syntax legacy)

---

**Grade: A- for general adoption**

**Created by Captain WOLFIE using The WOLFIE Way**  
**Platform: LUPOPEDIA - Ontology Knowledge Platform**  
**Date: November 3, 2025**
