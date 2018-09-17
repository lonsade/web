///CSS VARS
var width_creating_mark = '80px';
var width_creating = '348px';
var height_creating = '302px';
$(document).ready(function () {
    ///JQUERY OBJECT
    var list_el = $('#menu_block > li');
    var prev_drop = null;
    var cur = null;
    ///FLAGS
    var active = false;
    var action = false;
    var drop_made = false;
    var free = false;
    var out_able = false;
    var hover_was;
    ///INTEGERS
    var idt;
    var timeoutId;
    var timeoutId1;
    var count_marks = 0;
    ///HTML STRINGS
    var exchange_html;
    var id_mark;
    
    
     function do_draggable(obj) {
        obj.draggable({
            scroll: false
            , start: function () {
                prev_drop = null;
                drop_made = false;
                out_able = false;
                cur = null;
                $(this).parent().removeClass('busy_place');
            }
            , stop: function () {
                $(this).parent().addClass('busy_place');
                if (!drop_made) {
                    $(this).removeAttr('style');
                }
            }
        });
    }
    
    
    
    ///INIT HOVER MARKS
    
    
    
    
    
    
    
    function hover_marks() {
        $('.thebookmark').hover(function () {
            if ($(this).parent().hasClass('busy_place')) {
                clearTimeout(idt);
                var cur = $(this);
                hover_was = false;
                idt = setTimeout(function () {
                    hover_was = true;
                    if (id_mark == cur.parent().attr('id')) {
                        clearTimeout(timeoutId1);
                    }
                    cur.prev().show();
                    return true;
                }, 100);
            }
        }, function () {
            clearTimeout(idt);
            if (hover_was) {
                if ($(this).parent().hasClass('busy_place')) {
                    var cur = $(this);
                    timeoutId = setTimeout(function () {
                        cur.prev().hide();
                    }, 150);
                }
            }
        });
    }
    hover_marks();
    ///INIT HOVER ABOUT MARK
    function hover_about_mark() {
        $('.about_mark').hover(function () {
            clearTimeout(timeoutId);
            $(this).css({
                height: 'auto'
            });
            var h = $(this).height();
            $(this).css({
                height: '0px'
            });
            $(this).stop();
            $(this).animate({
                height: h
            }, 150, function () {
                $(this).children('.info_mark').css({
                    opacity: 1
                });
            });
        }, function () {
            $(this).stop();
            $(this).children('.info_mark').css({
                opacity: 0
            });
            $(this).animate({
                height: 0
            }, 150);
            cur = $(this);
            id_mark = cur.parent().attr('id');
            timeoutId1 = setTimeout(function () {
                cur.hide();
            }, 150);
        });
    }
    hover_about_mark();
    ///ANIMATE OF REMOVE BLOCK OF CREATION
    function remove_creation() {
        if (active) {
            action = false;
            var cm = $('#bookmark_create > .creating_mark');
            $(document).off('keyup');
            cm.children().animate({
                opacity: 0
            }, 150, function () {
                $(this).hide();
                cm.animate({
                    width: width_creating_mark
                }, 150, function () {
                    cm.animate({
                        height: 0
                    }, 150, function () {
                        active = false;
                        action = true;
                    });
                });
            });
        }
    }
    ///ANIMATION OF SAVE MARK AND ADDING BOOKMARK
    function save_creation() {
        var free_places = $('#menu_block li:not(.busy_place)');
        if (free_places.length) {
            remove_creation();
            count_marks++;
            var free_place = free_places.first().addClass('busy_place');
            free_place.html('<div id="bookmark_'+count_marks+'" class="el_bookmark"><div class="menu_info">' + $.trim($('#name_mark > input').val()) + '</div><div class="menu_info_hover"></div><div class="menu_footer"></div></div>');
            do_draggable(free_place.children());
        }
        else {
            ///Overload bookmarks
            $('#bookmark_create .error').show();
        }
    }
    ///ANIMATION OF OPENNING BLOCK OF CREATION
    list_el.on('click', '#bookmark_create>.menu_info', function(){
        if (!active) {
            action = false;
            var cm = $('#bookmark_create > .creating_mark');
            $('#url_mark > input').val(location.href);
            active = true;
            cm.animate({
                height: height_creating
            }, 150, function () {
                cm.animate({
                    width: width_creating
                }, 150, function () {
                    cm.children().show().animate({
                        opacity: 1
                    }, 150, function () {
                        action = true;
                        $(document).on('keyup', function (e) {
                            if (e.which == 27) {
                                remove_creation();
                            }
                            else if (e.which == 13) {
                                save_creation();
                            }
                        });
                    });
                });
            });
        }
        else {
            if (action) remove_creation();
        }
    });
    ///ACTION ON BUTTON OF CLOSE BLOCK OF CREATION
    list_el.on('click', '#bookmark_create .close_cm', function(){
        remove_creation();
    });
    ///ACTION ON BUTTON OF SAVE BOOKMARK
    list_el.on('click', '#bookmark_create .save_mark', function(){
        save_creation();
    });
    ///DISABLE SELECTION TEXT AT BOOKMARKS
    list_el.disableSelection();

    
    
    
    
    
    
    
    ///SETTING OF WIDGET DRAGGABLE 
    do_draggable(list_el.children());
    
    
    
    ///DISABLE DRAGGING ALL FREE BLOCKS
    list_el.children().not('.busy_place, .el_menu, .el_cr_bookmark').draggable('disable');
    ///SETTING OF WIDGET DROPPABLE   
    list_el.droppable({
        out: function (e, ui) {
            /*if (cur.hasClass('ui-droppable-hover')) {
                ///Previous drop didn't get event over
                //out_able = false;
                //idt = setTimeout(function () {
                ///    if (cur.hasClass('busy_place')) {
                //        prev_drop = cur;
               //         free = false;
                //        out_able = true;
                //        exchange_html = prev_drop.html();
                //        ui.draggable.removeClass('drag_place').addClass('busy_place').html(exchange_html);
                //        prev_drop.removeClass('busy_place').empty();
               //     }
                //    else {
               //         free = true;
               //     }
               // }, 50);
            }
            if (out_able) {
                out_able = false;
                $(this).addClass('busy_place').html(ui.draggable.html());
                ui.draggable.addClass('drag_place').removeClass('busy_place').html('<div class="about_mark"><div class="settings_mark"></div><div class="info_mark"></div></div><a class="thebookmark"></a>');
            }
            else {
                clearTimeout(idt);
            }*/
        }
        , over: function (e, ui) {
            /*cur = $(this);
            if (out_able) {
                ///Previous drop didn't get event out
                //prev_drop.addClass('busy_place').html(ui.draggable.html());
                //ui.draggable.addClass('drag_place').removeClass('busy_place').html('<div class="about_mark"><div //class="settings_mark"></div><div class="info_mark"></div></div><a class="thebookmark"></a>');
            }
            out_able = false;
            clearTimeout(idt);
            idt = setTimeout(function () {
                if (cur.hasClass('busy_place')) {
                    prev_drop = cur;
                    free = false;
                    out_able = true;
                    exchange_html = prev_drop.html();
                    ui.draggable.removeClass('drag_place').addClass('busy_place').html(exchange_html);
                    prev_drop.removeClass('busy_place').empty();
                }
                else {
                    free = true;
                }
            }, 50);*/
            /*
            if (ui.draggable.attr('id') != $(this).children().attr('id')){
                exchange_html = ui.draggable.parent().html();
                ui.draggable.parent().append($(this).html()).css('bottom', '80px');
                $(this).html(exchange_html);
                $(this).children().removeAttr('style');
            }
            */
            
        }
        , drop: function (e, ui) {
            clearTimeout(idt);
            drop_made = true;
            ui.draggable.removeAttr('style');
            exchange_html = ui.draggable.parent().html();
            ui.draggable.parent().empty();
            $(this).addClass('busy_place').html(exchange_html);
            do_draggable($(this).children());
        }
    });
    ///WORK WITH CANVAS
    var canvas = document.getElementById('close_cm');
    var ctx = canvas.getContext('2d');
    ctx.fillStyle = '#71ffff';
    ctx.beginPath();
    ctx.moveTo(5, 2);
    ctx.lineTo(19, 16);
    ctx.quadraticCurveTo(20, 18, 19, 19);
    ctx.quadraticCurveTo(18, 20, 16, 19);
    ctx.lineTo(2, 5);
    ctx.quadraticCurveTo(1, 3, 2, 2);
    ctx.quadraticCurveTo(3, 1, 5, 2);
    ctx.fill();
    ctx.beginPath();
    ctx.moveTo(16, 2);
    ctx.lineTo(2, 16);
    ctx.quadraticCurveTo(1, 18, 2, 19);
    ctx.quadraticCurveTo(3, 20, 5, 19);
    ctx.lineTo(19, 5);
    ctx.quadraticCurveTo(20, 3, 19, 2);
    ctx.quadraticCurveTo(18, 1, 16, 2);
    ctx.fill();
    canvas = document.getElementById('save_mark');
    ctx = canvas.getContext('2d');
    ctx.fillStyle = '#71ffff';
    ctx.beginPath();
    ctx.moveTo(8, 18);
    ctx.lineTo(8, 3);
    ctx.quadraticCurveTo(9, 1, 10.5, 1);
    ctx.quadraticCurveTo(12, 1, 13, 3);
    ctx.lineTo(13, 18);
    ctx.quadraticCurveTo(12, 20, 10.5, 20);
    ctx.quadraticCurveTo(9, 20, 8, 18);
    ctx.fill();
    ctx.beginPath();
    ctx.moveTo(3, 8);
    ctx.lineTo(18, 8);
    ctx.quadraticCurveTo(20, 9, 20, 10.5);
    ctx.quadraticCurveTo(20, 13, 18, 13);
    ctx.lineTo(3, 13);
    ctx.quadraticCurveTo(1, 12, 1, 10.5);
    ctx.quadraticCurveTo(1, 9, 3, 8);
    ctx.fill();
});