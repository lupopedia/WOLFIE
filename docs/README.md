---
title: README.md
agent_username: wolfie
agent_id: 008
channel_number: 001
version: 2.0.2
date_created: 2025-11-09
last_modified: 2025-11-17
status: placeholder
onchannel: 1
tags: [SYSTEM, DOCUMENTATION]
collections: [WHO, WHAT, WHERE, WHEN, WHY, HOW, DO, HACK, OTHER]
in_this_file_we_have: [NOTE, AGENT_COMMUNICATION_PROTOCOL, DEPENDENCY_REFERENCES]
superpositionally: ["FILEID_GITHUB_WOLFIE_DOCS"]
shadow_aliases: []
parallel_paths: []
---

# Documentation Placeholder

Comprehensive WOLFIE orchestrator documentation will accompany the public release. For now, see:

- `public/agent_profiles/8_WOLFIE_agent_profile_config.htm` (LUPOPEDIA) for legacy profile details.  
- `public/who_is_wolfie.php` on lupopedia.com for the five-context identity and philosophical overview.

## AGENT_COMMUNICATION_PROTOCOL

**📚 Complete Protocol Documentation**: LUPOPEDIA_PLATFORM `docs/AGENT_COMMUNICATION_PROTOCOL.md`

WOLFIE (Agent 008) implements the Agent Communication Protocol (Receptionist Model):

```
User Request
    ↓
WOLFIE (008) - Reads WOLFIE Headers v2.0.2, routes tasks
    ↓
WOLFIE (007) - Tactical operator, transfers to VISH
    ↓
VISHWAKARMA (075) - Normalizes requests, tracks changes
    ↓
Response
```

**Key Philosophy**: WOLFIE (007) doesn't know what he's doing, but knows who to transfer to (VISH). The system works anyway. Brittleness is a feature.

**For detailed protocol documentation**, see: https://github.com/lupopedia/LUPOPEDIA_PLATFORM/blob/main/docs/AGENT_COMMUNICATION_PROTOCOL.md

## DEPENDENCY_REFERENCES

**WOLFIE Headers v2.0.2** (Required Dependency):
- GitHub: https://github.com/lupopedia/WOLFIE_HEADERS
- Release: https://github.com/lupopedia/WOLFIE_HEADERS/releases/tag/v2.0.2
- Status: Latest Release (Current)
- Features: Database integration, agent file naming, validation scripts

**LUPOPEDIA_PLATFORM v0.0.8** (Layer 1):
- GitHub: https://github.com/lupopedia/LUPOPEDIA_PLATFORM
- Status: Private INVITE-ONLY BETA
- Features: Functional command system, Agent Communication Protocol
- Channel Architecture Phase 1 (Complete):
  - Database column: `channels.user_id` (verified from `data/csv/channels_rows.csv`)
  - Direct mapping: Agent ID = Channel Number (000-999, maximum 999)
  - Channel.php methods: `isValidChannelId()`, `loadByAgentId()`, `createForAgent()`, `getZeroPaddedId()`
  - Test script: `public/agents/wolfie/test_channel_phase1.php` - 23/23 tests passed (100% success rate)
- Channel Architecture Phase 2 (Complete):
  - ChannelController.php updated with agent mapping methods
  - `getChannelByAgentId($agentId)` - Get channel by agent ID using direct mapping
  - `switchToAgentChannel($agentId, $createIfNotExists = false)` - Switch to agent's channel
  - Fixed recursive call bug in `switchChannel()` method
  - Direct mapping: Agent ID = Channel Number (000-999, maximum 999)
  - Integration with Channel.php Phase 1 methods
  - Error handling for invalid agent IDs
  - Optional channel creation support
  - Activity logging for agent channel switches

