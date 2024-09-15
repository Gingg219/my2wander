(function($) {

    var mobileAgents = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (mobileAgents.Android() || mobileAgents.BlackBerry() || mobileAgents.iOS() ||
                mobileAgents.Opera() || mobileAgents.Windows());
        }
    };


    /* Image width
    ------------------------------------------------------*/
    function bynImgExpand() {
        var innerViewport = $('body').innerWidth();
        var innerViewportHalf = $('body').innerWidth() / 2;

        $("img[alt*='full image']").each(function(i) {
            $(this).parents('.tr-caption-container').addClass('img-gallery-full');
            $(this).parents('.tr-caption-container').css({
                'width': innerViewport,
                'margin-right': 'calc(50% - ' + innerViewportHalf + 'px)',
                'margin-left': 'calc(50% - ' + innerViewportHalf + 'px)',
            });
        });
        $("img[alt*='wide image']").each(function(i) {
            $(this).parents('.tr-caption-container').addClass('img-gallery-wide');
            $(this).parents('.tr-caption-container').css({
                'width': innerViewport,
                'margin-right': 'calc(50% - ' + innerViewportHalf + 'px)',
                'margin-left': 'calc(50% - ' + innerViewportHalf + 'px)',
            });
        });
    }
    $(window).resize(bynImgExpand);


    /* Related post img replace
    ------------------------------------------------------*/
    $('ul.related-posts-inner li img').attr('src', function(i, src) {
        return src.replace('s72-c', 's640');
    })
    $('ul.related-posts-inner li img').attr('src', function(i, src) {
        return src.replace('s72-w', 'w');
    })
    $('ul.related-posts-inner li img').attr('src', function(i, src) {
        return src.replace('default.html', 'maxresdefault.html');
    })


    /* Remove if empty
    /* ------------------------------- */
    str = $('#comments').text();
    if ($.trim(str) === "") {
        $('#comments').remove();
    }
    str = $('.FeaturedPost div[role="feed"]').text();
    if ($.trim(str) === "") {
        $('.FeaturedPost').remove();
    }
    str = $('.footer-top').text();
    if ($.trim(str) === "") {
        $('.footer-top').remove();
    }


    // <![CDATA[

    /* Mobile menu overlay
    /* ------------------------------- */
    if (mobileAgents.any()) {
        $('.toggle-menu').click(function() {
            $('.header-menu').toggleClass('active');
            $('body').toggleClass('no-scroll');
        });
    }


    /* Append mobile menu icon on Pages
    /* ------------------------------- */
    $('.toggle-menu').append('<span class="icon-hamburger"/>');


    /* Adding Tweet button to Blockquote
    /* ------------------------------- */
    $("blockquote").each(function() {
        var completeurl = window.location.protocol + "//" + window.location.host + window.location
            .pathname + window.location.search;
        completeurl = encodeURIComponent(completeurl);

        var entityMap = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': '&quot;',
            "'": '&#39;',
            ";": '&#58;',
        };
        var tweetshare = "https://twitter.com/share?url=" + completeurl;
        var getquote = $(this).text().replace(/[&<>"';\/]/g, function(s) {
            return entityMap[s];
        });

        $(this).append("<p><a class='tweetthis' target='_blank' title='Tweet this' href='" +
            tweetshare + "&amp;text=" + getquote + " - via '>Tweet</a></p>")
    });


    /* Clear HTML formatting on post summary
    /* ------------------------------- */
    $('.main-content .Blog .post-summary').text(function() {
        return $(this).text().replace(/[&"';#\/]|(<i>)|(<\/i>)|(<b>)|(<\/b>)/g, '').replace(/(39)/g,
            '’');
    });

    //]]>


    /* Append Blogger data:message to element
    /* ------------------------------- */
    var getReadMore = "Read more";
    $(".related-post-item .related-post-heading h5 a").append("<span>" + getReadMore + "...</span>");


    /* Reload Hi-Res image for comment PP
    /* ------------------------------- */
    var x = document.getElementsByTagName('IMG');
    for (i = 0; i < x.length; i++) {
        var y = document.getElementsByTagName('IMG')[i];
        var z = y.getAttribute('src');
        var m = z.search('s35');
        if (m == -1) {
            // NO THING
        } else {
            document.getElementsByTagName('IMG')[i].removeAttribute('src');
            var d = z.replace("s35", "s120");
            document.getElementsByTagName('IMG')[i].setAttribute('src', d);
        };
    }


    /* Assign class if no post shown
    /* ------------------------------- */
    if ($('.no-posts-message')[0]) {
        $('body').addClass('no-post-available');
    }


    /* Responsive Video frame
    /* ------------------------------- */
    /* -- Find all iFrames -- */
    var $iframes = $(".widget iframe.BLOG_video_class");
    var vidWidth = '560';
    var vidHeight = '315';

    $iframes.each(function() {
        $(this).data("ratio", vidHeight / vidWidth)
            .removeAttr("width")
            .removeAttr("height");
    });

    $(window).resize(function() {
        $iframes.each(function() {
            var width = $(this).parent().width();
            $(this).width(width).height(width * $(this).data("ratio"));
        });
    }).resize();


    /* Comment initial name
    /* ------------------------------- */
    $(".comment-thread > ol > .comment").each(function() {
        var str = $(this).children(".comment-block").find(".comment-header > .user").text();
        $(this).find(".avatar-image-container").append("<span>" + str.charAt(0) + "</span>");
    });

})(jQuery);
// <![CDATA[
window.addEventListener('load', (event) => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('byn_animate_on');
                /*
                } else {
                  entry.target.classList.remove('byn_animate_on');
                */
            }
        });
    });

    const animateElements = document.querySelectorAll('.byn_animate_off');
    animateElements.forEach((el) => observer.observe(el));
});
//]]>