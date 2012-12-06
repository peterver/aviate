# Wut?
This is a default plugin -- it's mainly to show developers how easy it is to build for Dime. Let's get cracking, then.

## Getting started
1. Think of an idea for a plugin. As a mere Markdown file, I'm unable to help you with this. Terribly sorry.
2. Create a folder within [DIME INSTALL]/dime/plugins. You know, where I am. Within there, you'll need to create an about.json file with some metadata in it. All of the keys in my about.json are correct and what you'll need as a minimum, so just copy that.
3. Change the values to suit (obviously). Arguably, the most important one is "file", which is the pathname/filename to the file that gets called when your plugin is activated. From here, it's just a standard PHP script on steriods. Code at your will.
4. Get some hooks and actions set up. Speaking of which...

## Filters and actions
When you make a plugin for Dime, you mainly interact using the Plugins class, which has a few static methods for you to use.
* Plugins::action($actionName, $function);
* Plugins::filter($hookName, function() use($currentValue) { });

A full list of hooks should be documented. If not, give me a slap.



aaaaaaand to build this shit now