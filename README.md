# README

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
- __[column]__ up to 4 blocks can be included per region. Optionally a style, alignment and background image can be defined.
 - __size__: 100 (default), 66, 50, 33, 25. Indicates the percentage of the page width that the column will take.
 - __style__: white (default), ultra-light, light, dark, colored. The _colored_ style takes its settings from the _style_ custom-field of the page (accepted values: sports, clinical, human, isen).
 - __align__: center, left (defaut), right.
 - __iamge__: name of the image located at ```<page_url>/images/```. In addition, indicate the __height__ in pixels.

It is possible to create an index of regions, using the ```inner-links``` class and the rows' id (see example below).

## Images

Use the ```[image]``` shortcode to insert images located at ```<page_url>/images/```.

- __name__: filename (can include a subdirectory), no spaces.
- __caption__: caption to be included with the image (no caption by default).
- __shadow__: adds a light shadow around the image (added by default). To remove shadow: ```[image ... shadow=no]```.
- __icon__: special image mode that fixes size to 80x80 and removes shadow.
- __alt__: the alt text, used when images cannot be displayed, for accessibility and by search engines. If empty (default value) then uses caption (if any) or image filename at last instance.
- __lazy__: image will be loaded only when the user scrolls up to it. During load, an animated GIF is shown. Use with big images to accelerate initial page load.
- __page__: the image is a link to a page, indicate with this attribute the slug of the page.
- __url__: the image is a link, indicate here the full URL.

## Links

Links to pages within this site can be done using ```[link page=<page_name> title="Optional title"]```. If title is not provided, the page title is used.

Links to external URLs are similar ```[link url=<url> title="Text to use for link"]```. In this case if the title is empty, the URL will be used.

Finally, a link to an e-mail can be done using ```[email to=<account> title="Optional title"]```. If title is empty, the e-mail address will be used instead. For example, ```[email to=info]``` will generate an e-mail link to info@stt-systems.com.

## Downloads

It is possible to generate automatic content based on file lists. In this case, files are stored in subdirectories of ```<page_url>/downloads/``` and have a JSON file describing its content (that must be called __index.json__).

The download list is included in the page using the ```[downloads]``` shortcode. Options:
- __name__: name of the directory within the downloads folder.
- __title__: title for the downloads list (defualt _Downloads_).
- __type__: list (default), gallery. The list will generate a list of links with the title of each file. The gallery will generate a grid of icons (based on file extension), galleries has no title.
- __zip__: generates a zip file, valid only for gallery type (default to yes).

Example: ```[downloads name=brochure type=gallery]```.

It is also possible to generate a single download link using just ```[download name=<path_within_downloads>]```.

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
		]
}
```

Each entry has a __file__ (containg the full filename), and a __title__.

## Other shortcodes:

- __[video]__
 - __name__: video code
 - __caption__: optional caption to add
 - __type__: youtube, facebook
 - __time__: time within video where to start playing (YouTube only)
- __quote__:
 - __text__
 - __title__
 - __author__
 - __style__: quote
-


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