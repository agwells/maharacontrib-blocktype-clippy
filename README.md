maharacontrib-blocktype-clippy
==============================

A Mahara blocktype that adds a helpful animated helper to your portfolio pages.

### Description:

Coming out of the 2014 NZ Mahara Hui, one of the main things I 
heard from Mahara's users was concerns about usability. They 
wanted Mahara to be easier to learn, and more fun to use, especially for kids.

So, I checked up on what the kids are into these days. And it 
seems like they like brightly colored, irreverent animated 
characters. I looked around and found the great 
[Clippy.js](https://www.smore.com/clippy-js) library provides exactly that functionality.

And now I've brought it to Mahara! You're welcome!


### Installation:

##### Mahara 1.9
Just drag it into the blocktype directory like any other block plugin.

##### Mahara 1.8
In addition to dragging it into the blocktype directory, you'll need to
add this to your config.php to preload the required CSS stylesheet:

```php
$cfg->additionalhtmlhead = "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$cfg->wwwroot}/blocktype/clippy/theme/raw/static/style.css\" media=\"all\">";
```

##### Mahara 1.7 and earlier
You'll need to find some other way to put the 
required CSS stylesheet into the page header. Maybe customizing
your theme? Or copy the contents of clippy's style.css into the
theme's master style.css. The possibilities are endless!


### Usage:

Just add a Clippy block to one of the pages in your Portfolio, and
select the animated helper you want. They'll appear and provide you
with helpful advice while you're working on that page. They'll
also provide helpful advice to visitors to your page.


### FAQs:

Q: Can I make the helper agent appear on every page, instead of just
specific portfolio pages?

A: Nope! I mean, you could, but not with this plugin! You'd need to make Clippy into a sideblock, and that's not an installable plugin type just yet. Alternately, in Mahara 1.8 or later you could probably write Clippy into the $cfg->additionalhtmlhead setting.


Q: Is this for real?

A: It is a real, fully functional Mahara plugin that adds an animated paper clip to your portfolio pages, yes.


Q: How much time did this take?

A: A couple of hours on a weekend. It was a labor of love.


Q: What font works best with Clippy?

A: My usability experts recommend Comic Sans.


Q: What day is today?

A: It's April 1, 2014. Does that date have some kind of significance?
