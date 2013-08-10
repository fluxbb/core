(function($) {

    $('[data-toggle=tooltip]').tooltip({
        placement: 'bottom'
    });

    $('#navbar .nav > li').bind('mouseover', function() {
        id = '#sub'+this.id;
        if ( $(id).length > 0 ) {
            $('#navbar .nav > li').removeClass('active');
            $(this).addClass('active');
            $('.subnav > .active').removeClass('active');
            $(id+' > ul').parent('li').addClass('active');
            $(id+' > ul').show();
        }
    });

    c_data = [
        {date: "2008-01", posts: "12", topics: "21", users: "12"},
        {date: "2008-05", posts: "22", topics: "21", users: "32"},
        {date: "2008-06", posts: "12", topics: "20", users: "15"},
        {date: "2008-07", posts: "6", topics: "20", users: "54"},
        {date: "2008-11", posts: "11", topics: "20", users: "6"},
        {date: "2008-12", posts: "8", topics: "20", users: "45"},
        {date: "2009-04", posts: "33", topics: "11", users: "35"},
        {date: "2009-05", posts: "86", topics: "31", users: "27"},
        {date: "2009-06", posts: "49", topics: "10", users: "28"},
        {date: "2009-07", posts: "31", topics: "10", users: "63"},
        {date: "2009-08", posts: "62", topics: "15", users: "24"},
        {date: "2009-09", posts: "36", topics: "20", users: "74"},
        {date: "2009-10", posts: "45", topics: "22", users: "65"},
        {date: "2009-11", posts: "139", topics: "21", users: "87"},
        {date: "2009-12", posts: "74", topics: "22", users: "54"},
        {date: "2010-01", posts: "85", topics: "21", users: "35"},
        {date: "2010-02", posts: "92", topics: "23", users: "52"},
        {date: "2010-03", posts: "58", topics: "21", users: "65"},
        {date: "2010-04", posts: "44", topics: "21", users: "39"},
        {date: "2010-05", posts: "75", topics: "22", users: "24"},
        {date: "2010-06", posts: "55", topics: "30", users: "16"},
        {date: "2010-07", posts: "44", topics: "30", users: "49"},
        {date: "2010-08", posts: "67", topics: "30", users: "69"},
        {date: "2010-09", posts: "53", topics: "30", users: "81"},
        {date: "2010-10", posts: "69", topics: "30", users: "93"},
        {date: "2010-11", posts: "134", topics: "31", users: "53"},
        {date: "2010-12", posts: "141", topics: "23", users: "61"},
        {date: "2011-01", posts: "144", topics: "35", users: "51"},
        {date: "2011-02", posts: "148", topics: "31", users: "59"},
        {date: "2011-03", posts: "123", topics: "31", users: "64"},
        {date: "2011-04", posts: "114", topics: "44", users: "93"},
        {date: "2011-05", posts: "129", topics: "40", users: "36"},
        {date: "2011-06", posts: "119", topics: "41", users: "16"},
        {date: "2011-07", posts: "135", topics: "42", users: "57"},
        {date: "2011-08", posts: "126", topics: "42", users: "79"},
        {date: "2011-09", posts: "115", topics: "41", users: "56"},
        {date: "2011-10", posts: "128", topics: "42", users: "92"},
        {date: "2011-11", posts: "137", topics: "43", users: "89"},
        {date: "2011-12", posts: "131", topics: "50", users: "67"},
        {date: "2012-01", posts: "182", topics: "53", users: "43"},
        {date: "2012-02", posts: "144", topics: "52", users: "81"},
        {date: "2012-03", posts: "114", topics: "50", users: "63"},
        {date: "2012-04", posts: "114", topics: "50", users: "72"},
        {date: "2012-05", posts: "170", topics: "50", users: "93"},
        {date: "2012-06", posts: "100", topics: "50", users: "32"},
        {date: "2012-07", posts: "350", topics: "63", users: "89"},
        {date: "2012-08", posts: "142", topics: "60", users: "66"},
        {date: "2012-09", posts: "228", topics: "60", users: "78"},
        {date: "2012-10", posts: "128", topics: "60", users: "99"},
        {date: "2012-11", posts: "220", topics: "60", users: "46"},
        {date: "2012-12", posts: "331", topics: "70", users: "64"},
        {date: "2013-01", posts: "220", topics: "72", users: "77"},
        {date: "2013-02", posts: "226", topics: "70", users: "35"},
        {date: "2013-03", posts: "226", topics: "80", users: "95"},
        {date: "2013-04", posts: "212", topics: "80", users: "57"},
        {date: "2013-05", posts: "216", topics: "80", users: "80"},
        {date: "2013-06", posts: "361", topics: "93", users: "91"},
        {date: "2013-07", posts: "318", topics: "90", users: "76"},
    ];

    r_data = [
        {forum: "Forum 1", posts: "562"},
        {forum: "Forum 2", posts: "194"},
        {forum: "Forum 3", posts: "50"},
        {forum: "Forum 4", posts: "113"},
        {forum: "Forum 5", posts: "212"},
        {forum: "Forum 6", posts: "85"},
        {forum: "Forum 7", posts: "28"},
        {forum: "Forum 8", posts: "217"},
        {forum: "Forum 9", posts: "448"},
        {forum: "Forum 10", posts: "24"},
    ];

    if ( $('.graph-container').length > 0 ) {
        Morris.Area({
            element: 'hero-area',
            data: c_data,
            xkey: 'date',
            ykeys: ['topics', 'posts', 'users'],
            labels: ['Discussions', 'Messages', 'Users'],
            pointSize: 2,
            hideHover: 'auto'
        });

        Morris.Bar({
            element: 'hero-bar',
            data: r_data,
            xkey: 'forum',
            ykeys: ['posts'],
            labels: ['Forums'],
            barRatio: 0.4,
            xLabelAngle: 35,
            hideHover: 'auto'
        });
    }

})(jQuery);