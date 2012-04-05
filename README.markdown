## CakePHP-Soundcloud-Search-Plugin

This is a plugin for CakePHP to perform searches in Soundcloud.com.

@author @davidmh

@links http://twitter.com/davidmh

@license MIT License (http://www.opensource.org/licenses/mit-license.php)

### Requirements:

* PHP Version: 5.2+
* CakePHP Version: 2.x Stable
* A Soundclud app (Registration: http://soundcloud.com/you/apps)


### Installation:

  cd my/app/Plugin
  git clone git://github.com/davidmh/CakePHP-SoundcloudSearch-Plugin.git SoundcloudSearch

Add your Soundcloud App ID in my/app/Config/core.php

  Configure::write('Soundcloud.AppID', 'YOUR_APP_ID');

In your Controller:

  public $components = array('SoundcloudSearch.SoundcloudSearch');

In the Method:

    $results = $this->SoundcloudSearch->find(array(
      'filters' => array(
        'q' => 'Jardín de la Croix'
      ),
      'fields' => array('id', 'title', 'stream_url', 'duration', 'user')
    ));

The previous request will give you the following array:

    Array
    (
      [0] => Array
          (
              [id] => 14399564
              [duration] => 534459
              [title] => POMEROY - Polyhedron
              [user] => Array
                  (
                      [id] => 4438313
                      [permalink] => jardindelacroix
                      [username] => jardindelacroix
                      [uri] => http://api.soundcloud.com/users/4438313
                      [permalink_url] => http://soundcloud.com/jardindelacroix
                      [avatar_url] => http://i1.sndcdn.com/avatars-000008349008-24wlxq-large.jpg?b9f92e9
                  )

              [stream_url] => http://api.soundcloud.com/tracks/14399564/stream
          )

      [1] => Array
          (
              [id] => 14400037
              [duration] => 566027
              [title] => POMEROY - Boston Steamer
              [user] => Array
                  (
                      [id] => 4438313
                      [permalink] => jardindelacroix
                      [username] => jardindelacroix
                      [uri] => http://api.soundcloud.com/users/4438313
                      [permalink_url] => http://soundcloud.com/jardindelacroix
                      [avatar_url] => http://i1.sndcdn.com/avatars-000008349008-24wlxq-large.jpg?b9f92e9
                  )

              [stream_url] => http://api.soundcloud.com/tracks/14400037/stream
          )
    ...



### Function Reference:

The only method so far its find, wich takes an array of parameters with two functions

  array(
    'filters' => array(),  // optional, but doesn't make much sense without it
    'fields'  => array()   // optional with all the fields as default
  )

"filters" will add the given values to the search request, a detailed list of valid filters can be found [here](http://developers.soundcloud.com/docs/api/tracks)
"fields", if specified, will retrieve only those fields
