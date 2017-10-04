New in ClientConfig v2 is the ability to have context-specific values.

To enable this behaviour, go to System > System Settings in your manager and find the `clientconfig.context_aware` system setting. Enable it, and ClientConfig will start treating contexts differently.

[TOC]

## How are contexts handled?

Each context gets a separate value. This is incorporated in the loading of the setting values when MODX is initialized, and when it sees a specific context was requested, it will overwrite the global values with the values for that specific context.

When it comes to MODX core settings (system settings, context settings), ClientConfig will override those values if they share the same key.

## What about permissions?

At the moment there are no special permissions needed. ClientConfig only allows setting values to be updated for contexts that the logged in user can access. 

So if you don't want a user to have access to a specific context's values, you need to lock down their access to that context through the MODX ACLs.

