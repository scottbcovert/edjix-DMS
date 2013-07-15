GoogleTheme
===========

First of all, this theme is not quite production ready. Below are a short list of known issues that need to be fixed.

- There is a bug that tends to occur in the navigation. I think it is related to the display:hidden propery of the dropdown menus. You'll see it!
- Studio is not useable. Need to either pull in css from the base CE theme or write some new css here.
- The new action menu buttons will not display properly. Just need to write some css to accomadate them.
- The navigation does not play nice with Ajax. At this point ajax must be globally disabled via config_override.php.
- Email address widget needs some adjustments in EditView. Just cosmetic though.
- Global Search needs some fixin. Need to provide different code for CE and Commercial editions as the search works differently.
- ListView headers need work. popup selector, subpanels and normal listview all have issue related to action menu uglyness.
- Some work should be done on Home module regarding the popups to configure dashlets, add dashlets, select columns etc.
- Should probably change the css references to background images to use the getImage entryPoint.


To make an installable package follow these directions:
Mac OS X / Linux
1. navigate to the folder holding the theme files and execute the following command:
> zip -r GoogleTheme.v1.0.zip * -x \.* \*DS_Store'

Windows
1. You should be able to simply right click the containing folder and select "Send to > Compressed ZIP folder"


When developing changes you may need to clear the cache to get them to appear in Sugar. 
The quickest way to do this is to wipe out or remove this file in the Sugar root directory:
cache/themes/GooglePlus/pathCache.php

