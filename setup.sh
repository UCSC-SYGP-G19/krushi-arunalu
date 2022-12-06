#!/bin/bash
echo "Setting up Git hooks..."

# Setup pre-commit hook

if [ -e .git/hooks/pre-commit ];
then
    PRE_COMMIT_EXISTS=1
else
    PRE_COMMIT_EXISTS=0
fi

cp scripts/pre-commit .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit

if [ "$PRE_COMMIT_EXISTS" = 0 ];
then
    echo "Pre-commit git hook installed!"
else
    echo "Pre-commit git hook updated!"
fi

# Setup commit-msg hook

if [ -e .git/hooks/commit-msg ];
then
    COMMIT_MSG_EXISTS=1
else
    COMMIT_MSG_EXISTS=0
fi

cp scripts/commit-msg .git/hooks/commit-msg
chmod +x .git/hooks/commit-msg

if [ "$COMMIT_MSG_EXISTS" = 0 ];
then
    echo "Commit-msg git hook installed!"
else
    echo "Commit-msg git hook updated!"
fi