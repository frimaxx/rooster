﻿/**
 * @author  likaifei
 *
 * 描述：选择时间组件，先选择小时再选择分钟，只支持00-23小时、00-05-10...50-55分钟。回调函数的e为源对象。
 *
 * $("#timePicker").hunterTimePicker();
 *
 * $('.time-picker').hunterTimePicker({
 *      callback: function(e){
 *          ....
 *      }
 * });
 *
 */

(function ($) {
    $.hunterTimePicker = function (box, options) {
        var dates = {
            // hour: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'],
            hour: ['07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'],
            minute: ['00', '05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55'],
        };

        var box = $(box);

        var template = $('<div class="Hunter-time-picker" id="Hunter_time_picker"><div class="Hunter-wrap"><ul class="Hunter-wrap" id="Hunter_time_wrap"></ul></div></div>');

        var time_wrap = $('#Hunter_time_wrap', template);

        $(document).click(function() {
            template.remove();
        });

        box.click(function(event){
            event.preventDefault();
            event.stopPropagation();
            template.remove();
            var _this = $(this);
            var offset = _this.offset();
            var top = offset.top + _this.outerHeight() + 15;
            template.css({
                'left': offset.left,
                'top': top
            });
            buildTimePicker();
            $('body').append(template);

            $('.Hunter-time-picker').click(function(event){
                event.preventDefault();
                event.stopPropagation();
            });
        });

        function buildTimePicker(){
            buildHourTpl();
            hourEvent();
            minuteEvent();
            cleanBtnEvent();
        };

        function buildHourTpl(){
            var hour_html = '<p>Hour</p>';
            for(var i = 0; i < dates.hour.length; i++){
                var temp = box.val().split(":")[0];
                if(dates.hour[i]==temp){
                    hour_html += '<li class="Hunter-hour active" data-hour="' + dates.hour[i] +'"><ul class="Hunter-minute-wrap"></ul><div class="Hunter-hour-name">' + dates.hour[i] + '</div></li>';
                }else{
                    hour_html += '<li class="Hunter-hour" data-hour="' + dates.hour[i] +'"><ul class="Hunter-minute-wrap"></ul><div class="Hunter-hour-name">' + dates.hour[i] + '</div></li>';
                }
            }

            hour_html += '<li class="Hunter-clean"><input type="button" class="Hunter-clean-btn" id="Hunter_clean_btn" value="Clear"></li>'

            time_wrap.html(hour_html);
        };

        function buildMinuteTpl(cur_time){
            var poi = cur_time.position();
            var minute_html = '<p>Minute</p>';
            var temp = box.val().split(":")[1];
            for(var j = 0; j < dates.minute.length;j++){
                if(dates.minute[j]==temp){
                    minute_html += '<li class="Hunter-minute active" data-minute="' + dates.minute[j] + '">' + dates.minute[j] + '</li>';
                }else{
                    minute_html += '<li class="Hunter-minute" data-minute="' + dates.minute[j] + '">' + dates.minute[j] + '</li>';
                }
            }
            cur_time.find('.Hunter-minute-wrap').html(minute_html).css('left', '-' + (poi.left - 37) + 'px').show();
        };

        function hourEvent(){
            time_wrap.on('click', '.Hunter-hour', function(event){
                event.preventDefault();
                event.stopPropagation();
                var _this = $(this);

                time_wrap.find('.Hunter-hour').removeClass('active');
                time_wrap.find('.Hunter-hour-name').removeClass('active');
                time_wrap.find('.Hunter-minute-wrap').hide().children().remove();

                _this.addClass('active');
                _this.find('.Hunter-hour').addClass('active');

                var hourValue = _this.data('hour');
                var temp = box.val().split(":");
                if(temp.length > 1){
                    box.val(hourValue+":"+temp[1]);
                }else{
                    box.val(hourValue+":00");
                }
                buildMinuteTpl(_this);

                return false;
            });
        };

        function minuteEvent(){
            time_wrap.on('click', '.Hunter-minute', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var _this = $(this);

                var minuteValue = _this.data('minute');
                var temp = box.val().split(":")[0]+":"+minuteValue;
                box.val(temp);
                template.remove();

                if(options.callback) options.callback(box);

                return false;
            });
        };

        function cleanBtnEvent(){
            time_wrap.on('click', '#Hunter_clean_btn', function(event){
                event.preventDefault();
                event.stopPropagation();

                box.val('');
                template.remove();
                if(options.callback) options.callback(box);
                return false;
            });
        };
    };

    $.fn.extend({
        hunterTimePicker: function (options) {
            options = $.extend({}, options);
            this.each(function () {
                new $.hunterTimePicker(this, options);
            });
            return this;
        }
    });
})(jQuery);