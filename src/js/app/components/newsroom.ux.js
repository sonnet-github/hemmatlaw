import { TweenMax, Expo } from 'gsap/TweenMax';
import tinysort from 'tinysort';

class NewsRoom {

    constructor($elem) {

        this.$elem = $elem;
        this.data = {
            sort: false,
            term: 'all',
            tags: false
        }

    }

  init() {
    this.bindCustomSort();
    this.initNews();
  }

  bindCustomSort() {

    let $self = this;

    $self.$elem.find('.option').unbind('click');
    $self.$elem.find('.option').bind('click', function () {
        let val = $(this).attr('data-value');
        let label = $(this).text();
        let $valueField = $(this).parent().parent().find('.ar-top-select');
        $valueField.attr('data-value', val);
        $valueField.find('span').text(label);
        let sortFrags = val.split('|');
        $self.applySort(sortFrags[0], sortFrags[1].toLowerCase());
    });

    $(".selectDropdown").removeClass('toggle');
    
    }

    applySort(field, order = 'asc') {
        let $wrapper = this.$elem.find('.ln-wrap .ln-list');
        this.data.sort = { field: field, order: order }
        let $list = $wrapper.find('.ln-list-item');
        tinysort($list, { attr: 'data-' + field, order: order });
        return this;
    }

    applyTagFilter(tag) {

        this.data.tags = tag;
        this.applyFilters();
        this.yearpublished();

    }

    applyFilters() {
        let $self = this;
        let $wrapper = $self.$elem.find('.ln-wrap .ln-list');
        let $list = $wrapper.find('.ln-list-item');

        $list.hide();
        $list.removeClass('has-match');

        $list.each(function () {
            let termMatch = '|' + $self.data.term + '|';
            let terms = $(this).attr('data-terms');

            if (terms.includes(termMatch)) {
                $(this).addClass('has-match');
            }

        }).promise().done(function () {
            if ($self.data.tags) {
                $wrapper.find('.ln-list-item.has-match').each(function () {
                    let tags = $(this).attr('data-tags');

                    if (tags.toLowerCase().includes($self.data.tags.toLowerCase())) {

                    } else {
                        $(this).removeClass('has-match');
                        $(this).hide();
                    }
                }).promise().done(function () {
                    $wrapper.find('.ln-list-item.has-match').fadeIn(250);
                    if (!$wrapper.find('.ln-list-item.has-match').length) {
                    }
                });
            }
            $wrapper.find('.ln-list-item.has-match').fadeIn(250);
            if (!$wrapper.find('.ln-list-item.has-match').length) {
            }
        });


        return $self;
    }

    initNews() {
        var activeListsARBot = jQuery('.single-team-art-item');
        var activeitem = jQuery('.single-team-art-item.active');
        var loadMore = jQuery('.ln-btn a');
    }

}

$(document).ready(() => {
  if ($('.block--custom-layout__news').length) {
    let _module = new NewsRoom($('.block--custom-layout__news'));
    _module.init();
  }
});
