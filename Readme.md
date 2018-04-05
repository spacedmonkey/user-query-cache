User Query Cache
===================

This plugin, hooks deep into the WP_User_Query class, add caches the result of the query the first time, in object cache. Meaning the next time the same query is called, the result will be called from object cache. Adding this plugin, will improve performance on any sites where many / complex WP_User_Query are calls.  Best used as an mu-plugin. Once in place, it caches all calls to WP_User_Query on the page, wherever they are called.


If you wish to follow the development of this plugin, view the code on the official plugin [website](http://www.spacedmonkey.com/ "website") or follow me on twitter [@thespacedmonkey](https://twitter.com/thespacedmonkey)


## Installation

This section describes how to install the plugin and get it working.


### Uploading in WordPress Dashboard

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `user-query-cache.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

### Using FTP
1. Download `user-query-cache.zip`
2. Extract the `user-query-cache` directory to your computer
3. Upload the `user-query-cache` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard


## GitHub Updater

The User Query Cache includes native support for the [GitHub Updater](https://github.com/afragen/github-updater) which allows you to provide updates to your WordPress plugin from GitHub.

## License

The User Query Cache is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

> You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA


## Contributions

Anyone is welcome to contribute to User Query Cache

There are various ways you can contribute:

* Raise an issue on GitHub.
* Send us a Pull Request with your bug fixes and/or new features.
* Provide feedback and suggestions on enhancements.
