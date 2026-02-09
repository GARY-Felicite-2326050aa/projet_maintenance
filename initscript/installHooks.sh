#!/bin/sh

# Copier le hook dans .git/hooks/pre-commit
cp initscript/pre-commit .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit

echo "✅ Hook pre-commit installé avec succès !"
