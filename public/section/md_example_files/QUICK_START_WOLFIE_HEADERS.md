---
title: QUICK_START_WOLFIE_HEADERS.md
agent_username: wolfie
date_created: 2025-11-03
last_modified: 2025-11-03
status: published
onchannel: 1
tags: [SYSTEM, DOCUMENTATION]
collections: [HOW]
in_this_file_we_have: [QUICK_START, TEMPLATE, CHECKLIST, FAQ]
---

---

# Quick Start: WOLFIE Headers

## QUICK_START

**Need to create a new markdown file? Here's how:**

### Step 1: Copy This Template
```markdown
#your_filename_here.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SYSTEM"]
- **COLLECTIONS**: ["WHAT"] 
- **in_this_file_we_have**: ["SECTION1", "SECTION2"] 
## WOLFIE_END

# Your Title Here

Your content starts here...
```

### Step 2: Customize It
1. **Replace** `your_filename_here.md` with your actual filename
2. **Choose** appropriate TAGS from `md_files/1_wolfie/TAGS.md`
3. **Choose** appropriate COLLECTIONS from `md_files/1_wolfie/COLLECTIONS.md`
4. **List** your major sections in `in_this_file_we_have`

### Step 3: Done!
That's it. Write your content below the header.

---

## TEMPLATE

### Minimal Template (Required Fields Only)
```markdown
#filename.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SYSTEM"]
- **COLLECTIONS**: ["WHAT"] 
- **in_this_file_we_have**: ["OVERVIEW"] 
## WOLFIE_END
```

### Database Documentation Template
```markdown
#database_guide.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["DATABASE", "DOCUMENTATION"]
- **COLLECTIONS**: ["WHAT", "HOW", "WHERE"] 
- **in_this_file_we_have**: ["SCHEMA", "TABLES", "QUERIES", "EXAMPLES"] 
## WOLFIE_END
```

### Session Log Template
```markdown
#2025-11-03_session.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SESSION"]
- **COLLECTIONS**: ["WHEN", "WHAT"] 
- **in_this_file_we_have**: ["TASKS_COMPLETED", "DECISIONS_MADE", "NEXT_STEPS"] 
## WOLFIE_END
```

### Technical Documentation Template
```markdown
#system_architecture.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SYSTEM", "DOCUMENTATION"]
- **COLLECTIONS**: ["WHAT", "HOW"] 
- **in_this_file_we_have**: ["ARCHITECTURE", "COMPONENTS", "DESIGN", "EXAMPLES"] 
## WOLFIE_END
```

---

## CHECKLIST

### Before You Write
- [ ] Know your filename
- [ ] Check available TAGS in `md_files/1_wolfie/TAGS.md`
- [ ] Check available COLLECTIONS in `md_files/1_wolfie/COLLECTIONS.md`
- [ ] Plan your major sections

### Writing the Header
- [ ] First line is `#filename.md` (exact filename)
- [ ] Use `## WOLFIE_BEGIN` (not BEGIN_WOLFIE or WOLFIE-BEGIN)
- [ ] Set `onchannel: 1` (default channel)
- [ ] Choose 1-3 TAGS from TAGS.md
- [ ] Choose 1-4 COLLECTIONS from COLLECTIONS.md
- [ ] List 2-6 items in `in_this_file_we_have`
- [ ] End with `## WOLFIE_END`

### After the Header
- [ ] Leave one blank line
- [ ] Add `---` separator (optional but nice)
- [ ] Start your content
- [ ] Write sections matching `in_this_file_we_have`

---

## FAQ

### Q: What if I don't know which TAGS to use?
**A:** Look at `md_files/1_wolfie/TAGS.md` for the list. If nothing fits, use `["SYSTEM"]` as the default. You can always add more tags later.

### Q: What if I need a tag that doesn't exist?
**A:** Add it to `md_files/1_wolfie/TAGS.md`! Just follow the format:
```markdown
##YOUR_NEW_TAG
- **Meaning**: What this tag represents
- **Usage**: When to use this tag
```

### Q: Can I use multiple channels?
**A:** Not yet. For now, use `onchannel: 1`. Multiple channels are coming soon.

### Q: What goes in `in_this_file_we_have`?
**A:** List the major sections/headings in your file. This acts as a quick table of contents. Use UPPERCASE_WITH_UNDERSCORES for section names.

### Q: Do I need all the COLLECTIONS (WHO, WHAT, WHERE, WHEN, WHY, HOW)?
**A:** No! Only use the ones that make sense for your file. If it's a technical doc, maybe just `["WHAT", "HOW"]`. If it's a session log, maybe `["WHEN", "WHAT"]`.

### Q: Can I skip the header?
**A:** Please don't. Headers help AI agents understand your file quickly. It only takes 30 seconds to add.

### Q: What if I have an old AGAPE header?
**A:** Leave it for now. We'll migrate them later. If you're editing an old file, you can add the new WOLFIE header at the top and leave the old one below for comparison.

### Q: Is the first line really important?
**A:** Yes! `#filename.md` should exactly match your filename. This helps everyone know what file they're looking at.

---

## AVAILABLE_TAGS

From `md_files/1_wolfie/TAGS.md`:
- **SYSTEM** - Core system documentation
- **DATABASE** - Database-related content
- **DOCUMENTATION** - User guides and references
- **SESSION** - Session logs and tracking

---

## AVAILABLE_COLLECTIONS

From `md_files/1_wolfie/COLLECTIONS.md`:
- **WHO** - People, agents, entities
- **WHAT** - Descriptions, features, capabilities
- **WHERE** - Locations, paths, topology
- **WHEN** - Timestamps, schedules, timelines
- **WHY** - Purpose, motivation, strategy
- **HOW** - Implementation, methodologies

---

## EXAMPLES

### Example 1: Simple System Doc
```markdown
#system_status.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["SYSTEM"]
- **COLLECTIONS**: ["WHAT", "WHERE"] 
- **in_this_file_we_have**: ["OVERVIEW", "HEALTH_CHECK", "METRICS"] 
## WOLFIE_END

# System Status

## OVERVIEW
Current system health and status...

## HEALTH_CHECK
✅ Database: Healthy
✅ Application: Running

## METRICS
- Tables: 152
- Users: Active
```

### Example 2: Database Doc with Multiple Tags
```markdown
#migration_guide.md
## WOLFIE_BEGIN
- **onchannel**: 1
- **TAGS**: ["DATABASE", "DOCUMENTATION"]
- **COLLECTIONS**: ["HOW", "WHAT"] 
- **in_this_file_we_have**: ["OVERVIEW", "PROCESS", "EXAMPLES", "TROUBLESHOOTING"] 
## WOLFIE_END

# Database Migration Guide

## OVERVIEW
How to run database migrations...

## PROCESS
Step-by-step instructions...

## EXAMPLES
Example migrations...

## TROUBLESHOOTING
Common issues and fixes...
```

---

## TIPS

### Keep It Simple
- Don't overthink TAGS and COLLECTIONS
- Start with basics, refine later
- Most files can use just `["SYSTEM"]` and `["WHAT"]`

### Be Consistent
- Always start with `#filename.md`
- Always use channel 1 for now
- Always use `WOLFIE_BEGIN` and `WOLFIE_END` (exact spelling)

### Make It Useful
- Choose tags that help organize files
- List actual sections in `in_this_file_we_have`
- Use collections that match your content

### Update When Needed
- If you add a section, update `in_this_file_we_have`
- If content changes focus, update TAGS/COLLECTIONS
- Keep headers accurate and helpful

---

## NEED_HELP?

### Full Documentation
- `md_files/WOLFIE_HEADER_SYSTEM.md` - Complete system guide
- `md_files/CHANNELS.md` - Channel reference
- `md_files/1_wolfie/README.md` - Channel 1 details

### Comparison
- `md_files/WOLFIE_VS_AGAPE_COMPARISON.md` - See old vs new

### Examples
- `README.md` - Root readme uses WOLFIE header
- `md_files/README.md` - MD files readme uses WOLFIE header

---

**Created:** 2025-11-03  
**Purpose:** Get started with WOLFIE headers in 60 seconds  
**Status:** ✅ Ready to use

