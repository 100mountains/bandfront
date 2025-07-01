By default, the plugin lists the posts in an unordered list with the lcp_catlist CSS class, like this:

<ul class="lcp_catlist">
So if you want to customize the appearance of the List Category Posts lists, you can just edit the lcp_catlist class in your theme's CSS.

Additionally, the li element containing the link to the current post always gets the current CSS class.

You can also customize what HTML tags different elements will be surrounded with, and set a CSS class for this element, or just a CSS class which will wrap the element with a span tag.

The customizable elements (so far) are: author, category_description, catlink (category link), comments, content, customfield, date, excerpt, morelink ("Read More" link), thumbnail, title (post title), posts_cats, posts_tags.

The parameters are: author_tag, author_class, category_description_tag, category_description_class, catlink_tag, catlink_class, comments_tag, comments_class, conditional_title_tag, conditional_title_class, content_tag, content_class, date_tag, date_class, date_modified_tag, date_modified_class, excerpt_tag, excerpt_class, morelink_tag, morelink_class, thumbnail_tag, thumbnail_class, title_tag, title_class, posts_morelink_class, customfield_tag, customfield_class, posts_cats_tag, posts_cats_class, posts_tags_tag, posts_tags_class

So let's say you want to wrap the displayed comments count with the p tag and a "lcp_comments" class, you would do:
[catlist id=7 comments=yes comments_tag=p comments_class=lcp_comments]
This would produce the following code:

<p class="lcp_comments"> (3)</p>
You can use multiple classes like you normally do in HTML: [catlist comments=yes comments_class="opinions comments"]

Or you just want to style the displayed date, you could wrap it with a span tag:
[catlist name=blog date=yes date_tag=span date_class=lcp_date]
This would produce the following code:

<span class="lcp_date">March 21, 2011</span>
Elements without a specified tag, but a specified class, will be wrapped with a span tag and its class. For example this:
[catlist id=7  date=yes date_class="lcp_date"]
Will produce the following:

<span class="lcp_date">October 23, 2013</span>
The exceptions here are:

the title_tag and title_class parameters. If you only use the title_class parameter, the CSS class will be assigned to the a tag like this:
[catlist id=1 title_class="lcp_title"]
Will produce:
<a href="http://127.0.0.1/wordpress/?p=38" class="lcp_title">Test</a>
But if you use both:
[catlist numberposts=5 title_class=lcp_title title_tag=h4]
You will get:

<h4 class="lcp_title">
    <a href="http://127.0.0.1:8080/wordpress/?p=38">Test</a>
</h4>
the thumbnail_class parameter. The class will be added to the img element. [catlist id=13 thumbnail=yes thumbnail_class="lcp_thumbnail"] Will produce:
<a href="http://localhost:8080/?p=1016" title="Featured Image (Vertical)">
    <img src="http://localhost:8080/wp-content/uploads/2013/03/featured-image-vertical-150x150.jpg" class="lcp_thumbnail wp-post-image" alt="Vertical Featured Image" srcset="http://localhost:8080/wp-content/uploads/2013/03/featured-image-vertical-150x150.jpg 150w, http://localhost:8080/wp-content/uploads/2013/03/featured-image-vertical-100x100.jpg 100w" sizes="(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px" width="150" height="150">
</a>
the thumbnail_tag parameter. It only specifies a tag to wrap the <img> element with. If you use [catlist id=13 thumbnail=yes thumbnail_tag="div" thumbnail_class="lcp_thumbnail"] you will get the same output as above but it will also be wrapped in a <div>. The class is still assigned to the <img>, not the <div>.
the posts_morelink_class parameter. The class is assigned to the <a> element itself. There is no tag you can specify to wrap the link with.
Templates
IMPORTANT: If you use custom templates, shortcode parameters regarding tags and classes take precedence over arguments you pass to template methods. So, if you have in your template, for example:

get_conditional_title('h2', 'my-conditional-title');
it will work as expected but if you add to your shortcode conditional_title_tag=h3 and/or conditional_title_class="another-class", these shortcode parameters will take precedence over 'h2' and 'my-conditional-title'.

Private posts
When logged in as an admin, you'll see the text private next to a post's title if it's a private post. You can customize the .lcp_private class in your theme's CSS for the display of this text, since it's published with the following html:

<span class="lcp_private"> private</span>