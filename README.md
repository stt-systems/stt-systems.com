# README

This theme is an adaptation of the [Weblizar](https://wordpress.org/themes/weblizar/) theme, and is designed to be used in the webpage of [STT Systems](https://www.stt-systems.com). Its use in any other WP installation will probably require changes in the source code (such as the domain name for emails, logos, etc).

## Basic ayout

You can add horizontal regions (_rows_) each of them divided in vertical blocks (_columns_).

```
[row]
[column]
Basic row
[/column]
[/row]
```

Use ```[row] ... [/row]``` to enclose a region and ```[column] ... [/column]```to create a block.

  - __[row]__
    - __id__: id used to identify the region for linking purposes
    - __margin__: can be used to suppress top, bottom or both content margins (no-top, no-bottom, no-top-bottom).

  - __[column]__ up to 4 blocks can be included per region. Optionally a style, alignment and background image can be defined.
    - __size__: 100 (default), 75, 66, 50, 33, 25, 16. Indicates the percentage of the page width that the column will take.
    - __style__: white (default), ultra-light, ultra-ligth-blue, light, light-blue, dark, colored. The _colored_ style takes its settings from the _style_ custom-field of the page (accepted values: sports, clinical, human, isen). The -blue variant simply changes the color of the inner-links to STT's blue.
    - __align__: center, left (defaut), right.
    - __image__: name of the image (uploaded to WP). In addition, indicate the __height__ in pixels or the column won't be able to show the image correctly. A column with background cannot have any other content (yet).

It is possible to create an index of regions, using the ```inner-links``` class and the rows' id (see example below).

## Images

Use the ```[image]``` shortcode to insert images uploaded to the WP site using the regular media tool.
  - __name__: filename (can include a subdirectory), no spaces.
  - __caption__: caption to be included with the image (no caption by default).
  - __shadow__: adds a light shadow around the image (added by default). To remove shadow: ```[image ... shadow=no]```.
  - __icon__: if set, indicates the size of the image in icon mode (fixes size to _icon_ x _icon_, removes shadow and adds an extra bottom space).
  - __alt__: the alt text, used when images cannot be displayed, for accessibility and by search engines. If empty (default value) then uses caption (if any) or image filename at last instance.
  - __lazy__: image will be loaded only when the user scrolls up to it. During load, an animated GIF is shown. Use with big images to accelerate initial page load.
  - __page__: the image is a link to a page, indicate with this attribute the slug of the page. Anchors can be added if needed (see _links_ below).
  - __url__: the image is a link, indicate here the full URL.

There is a special way to insert a side-to-side image, using the ```[banner]``` shortcode. It will adjust correctly to different devices. Banners will be rendered using 600px height in desktop.
  - __image__: name of the image to use as banner.

## Links

Links to pages within this site can be done using ```[link page=<page_name> title="Optional title"]```. If title is not provided, the page title is used. An anchor within the page can be used, for example ```[link page=isen#realtime]```.

Links to external URLs are similar ```[link url=<url> title="Text to use for link"]```. In this case if the title is empty, the URL will be used.

Finally, a link to an e-mail can be done using ```[email to=<account> title="Optional title"]```. If title is empty, the e-mail address will be used instead. For example, ```[email to=info]``` will generate an e-mail link to info@stt-systems.com. If an _at symbol_ (@) is found in the ```to``` parameter, then the _@stt-systems.com_ domain is omitted and the e-mail address is used as provided, so ```[email to=stt@domain.com]``` will generate an e-mail link to stt@domain.com.

## Downloads

It is possible to generate automatic content based on file lists. In this case, files are stored in subdirectories of ```<page_url>/downloads/``` and have a JSON file describing its content.

The download list is included in the page using the ```[downloads]``` shortcode. Options:
  - __name__: name of the directory within the downloads folder.
  - __title__: title for the downloads list (default _Downloads_).
  - __type__: list (default), gallery. The list will generate a list of links with the title of each file. The gallery will generate a grid of icons (based on file extension), galleries has no title. It is possible to indicate a preview image for a file, to do so just create a JPEG or PNG image (245px as largest edge) and with the same name but ```-thumb.png``` or ```-thumb.jpg``` as suffix: thumbnail for ```A.pdf``` should be named ```A-thumb.jpg``` (images can also have a thumbnail, avoiding the load of the full-size image on the page). You can use the icons in ```<STT-theme>/images/file-types``` as a template. PNG files will be used if both PNG and JPEG files are used.
  - __index__: basename (without extension) of the JSON file with the files to be listed. If omitted, _index_ will be used (so ```index.json``` will be loaded). It allows having multiple views of the same files (subsets).

If the JSON file contains a ```"zip":"filename.zip"``` entry, it will generate a _Download all (ZIP)_ link at the end of the gallery.

Example: ```[downloads name=brochure type=gallery index=spanish]```.

It is also possible to generate a single download link using just ```[download name=<path_relative_to_downloads>]```.

### Sample JSON (index.json)
```
{
	"files": [
		{"file":"STT_Cycling3DMA_2016-E.pdf",
			"title":"Brochure (English)"},
		{"file":"STT_Cycling3DMA_2016-S.pdf",
			"title":"Brochure (Spanish)"},
		{"file":"STT_Cycling3DMA_report_es.pdf",
			"title":"Sample report (Spanish)"},
		{"file":"STT_Cycling3DMA_report_es.pdf",
			"title":"Sample report (Spanish)"},
		{"file":"STT_Cycling3DMA_Road_bike.pdf",
			"title":"Road bike measurement report (English)"}
		],
  "zip":"all-reports.zip"
}
```

Each entry has a __file__ (containg the full filename), and a __title__.

## Tables and lists

Tables and list should be created using traditional HTML code.

Tables should be wrapped using the ```[table] ... [/table]``` shortcode, this will allow the table to bahave correctly in mobile devices. The shortcode admits:
  - __clean__: special table with less decoration (yes, _no_)
  - __responsive__: mobile, _empty_ (default). Toggles table to single column in mobile devices
  - __width__: width of the table (usually not required). Default: 100%

It is possible to change the bullet color of an unordered list from style to gray, using the class ```light```. Example: ```<li class="light">Vertical jump/CMJ (*)</li>```.

## Other shortcodes and HTML classes

  - __[video]__
    - __name__: video code
    - __caption__: optional caption to add
    - __type__: youtube, facebook
    - __time__: time within video where to start playing (YouTube only)
		- __size__: use 100% to remove size constraints and fully adapt to container
  - __[quote]__:
    - __text__
    - __title__
    - __author__
    - __style__: quote
  - __[v-space]__: USE WITH CAUTION! Most of the time it is not necessary to use a v-space, since paragraphs and headers have their own vertical spaces. One good use is, for example, padding around images.
    - __size__ (=10, 20, ..., 100): inserts a vertical space. Should be avoided whenever is possible, since it creates layout blocks than may interfer with the responsive design.
  - __[distributor]__: keep an empty line between paragraphs to create actual new lines
    - __name__
    - __logo__
    - __products__: comma-separated list of products, using page slug as ID
    - __country__
    - __type__: premium, exclusive
    - __url__: if non-empty, both name and logo are converted into links, and a Website line is added
  - __[button]__: creates a link with button shape
    - __label__
    - __page__ / __download__ / __url__: the link to use
    - __sytle__
  - __[button-list]__: creates a column structure to generate aligned lists of buttons
    - __text__: text for the first column
    - __page__: generate a link
    - __width__ (25, 33, 50): approximate percentage of the screen used by buttons (default 25).
  - __[collapse]__: generates a collapsable block with the content
    - __id__: mandatory, must be unique within the page
    - __title__
    - __class__
    - __collapsed__: initial state (default: true)
  - __[post-list]__: generates a list of posts matching some parameters
    - __tag__ / __category__: slug of tag and/or category to filter
    - __count__: maximum number of posts to show (default: -1, meaning all)
    - __detalils__: set to show details like publication date and tags
    - __sortby__: how posts are sorted, using date (descendant), title (ascendant) or custom field (ascendant, use field name) (default: date)

By default, paragraphs add a bottom padding to separate from following paragraph. Sometimes this is not the desired behaviour, so all lines must be kept closer (as with lists, but without the bullet). To do so just use the ```[compact-paragraph] ... [/compact-paragraph]``` shortcode:

```
[compact-paragraph]
Line 1

Line 2

Line 3
[/compact-paragraph]
```
    
## FTP structure

  - /
    - downloads: base path for downloads
      - [donwload_group]
        - index.json: index file for the download group, in JSON format
    - wp-content/uploads: single images are stored here using the WP media tool (no sub dirs). Can include @2x version for HDPI displays.
      - backgrounds: background images for main pages
      - clients: client icons to be used in clients banners (sorted by filename)
      - icons: small images to be used in pages
      - logos: logos used in menus, SEO...

## Full example

```
[row]
[column align=center]
<h1>Cycling 3DMA</h1>
The ultimate solution for 3D cycling analysis and bike fitting

<div class="inner-links">
<a href="#full-body">FULL-BODY</a>
<a href="#real-time">REAL-TIME</a>
<a href="#analysis">ANALYSIS</a>
</div>
[/column]
[/row]


[row]
[column align=center image=cycling-3dma-image-01.jpg height=600]
[/column]
[/row]


[row id="full-body"]
[column size=50 align=right]
[image name=icons/icon_red_fullbody.png icon=true]
<h2>Full-body analysis</h2>
After a few seconds, Cycling 3DMA provides tracking data and automatic analysis of the entire body: yes, on every joint.
[/column]

[column size=50 align=center]
[image name=cycling-3dma-laptop-01.png shadow=false]
[/column]
[/row]


[row]
[column align=center style=colored]
[image name=icons/icon_red_precision.png icon=true]
<h2>100 FPS or higher</h2>
The data is acquired, processed and displayed to the filter at a frame rate of 100 Hz/FPS (Frames Per Second): a rider was pedalling at 120 rpm would register 50 'takes' for each pedal cycle, resulting in a very accurate interpolation even at high speeds.
[/column]
[/row]


[row id="real-time"]
[column size=50 align=right style=light]
[image name=icons/icon_red_realtime.png icon=true]
<h2>Real-time analysis</h2>
Motion capture cameras track markers in 3D space which are used to reconstruct the actual body motion. Use pan, tilt and zoom tools to move around at will.
[/column]

[column size=50 align=center]
[image name=cycling-3dma-config-01.png shadow=false]
[/column]
[/row]


[row]
[column size=50 style=dark align=center]
[image name=cycling-3dma-customer-03.jpg]
[/column]

[column size=50 style=dark]
[image name=icons/icon_white_3d.png icon=true]
<h2>True 3D</h2>
Data sets are presented live and automatically: Parameters, graphs and 3D views. Get immediate feedback for any dynamic adjustment of the bike.
[/column]
[/row]


[row id="analysis"]
[column size=66 style=white]
<h2>Analysis protocols</h2>
Cycling 3DMA includes a set of user-ready 'analysis protocols'. What exactly are these? Protocols are a combination of software tools tailored to analyze a specific gesture or sport. Each protocol involves a marker configuration, a list of plots, relevant biomechanical parameters, certain automatically calculated events, a dashboard and a report template.

All of these are carefully designed and work together to facilitate user's job. The goal: to move from data collection on to data processing &amp; results display as fast as possible.
[/column]

[column size=33]
<ul>
	<li>Full-body cycling analysis</li>
	<li>Left-side analysis only</li>
	<li>Right-side analysis only</li>
	<li>Road bike measurement</li>
	<li>TT/Tri bike measurement</li>
	<li>MTB bike measurement</li>
	<li class="light">Pre-fitting assessment (*)</li>
	<li class="light">Feet analysis only (*)</li>
</ul>
[/column]
[/row]
```
