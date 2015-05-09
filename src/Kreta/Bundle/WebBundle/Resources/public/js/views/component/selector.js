/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

export class SelectorView extends Backbone.View {
  constructor($el) {
    this.$el = $el;

    this.currentPos = 0;

    this.$selected = this.$el.children('.selector-text');
    this.$selected.focusin($.proxy(this.toggleSelector, this));
    this.$selected.focusout($.proxy(this.toggleSelector, this));
    this.$selected.keydown($.proxy(this.moveSelected, this));

    this.$choices = this.$el.children('.selector-choices');
    this.$choices.on(
      'mousedown', '.selector-selectable', ($.proxy(this.optionClicked, this))
    );

    this.onOptionSelectedCallback = null;
  }

  setSelectables(selectables) {
    this.$choices.html('');
    selectables.each((model) => {
      this.$choices.append(
        `<span class="selector-selectable" data-id="${model.get('id')}">${model.toString()}</span>`
      );
    });
  }

  toggleSelector(ev) {
    $(ev.currentTarget).parent().toggleClass('visible');
    if (this.$el.hasClass('visible')) {
      this.currentPos = 0;
      this.highlightOption(0);
    }
  }

  highlightOption(index) {
    var $items = this.$choices.find('.selector-selectable');
    $items.removeClass('selected');
    $($items.get(index)).addClass('selected');
  }

  moveSelected(ev) {
    if (ev.which === 38) { //Up
      if (this.currentPos > 0) {
        this.currentPos--;
        this.highlightOption(this.currentPos);
      }
      return;
    }
    if (ev.which === 40) { //Down
      this.currentPos++;
      this.highlightOption(this.currentPos);
      return;
    }
    if (ev.which === 13) {
      this.selectOption(
        $(this.$choices.find('.selector-selectable').get(this.currentPos))
      );
    }
  }

  optionClicked(ev) {
    var $selected = $(ev.currentTarget);
    this.selectOption($selected);
  }

  selectOption($selected) {
    var $input = $selected.parents('.selector').find('input');
    var $span = $selected.parents('.selector').children('span');
    $input.val($selected.attr('data-id')).trigger('change');
    $span.text($selected.text());
    $('[tabindex=' + (parseInt($span.attr('tabindex')) + 1) + ']').focus();
    if (this.onOptionSelectedCallback) {
      this.onOptionSelectedCallback($selected.attr('data-id'), $selected.text());
    }
  }

  onOptionSelected(callback) {
    this.onOptionSelectedCallback = callback;
  }
}
