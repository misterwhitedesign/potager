const { createElement, Fragment } = window.wp.element
const { registerFormatType, unregisterFormatType, toggleFormat } = window.wp.richText
const { __ } = window.wp.i18n
const { RichTextToolbarButton, RichTextShortcut } = window.wp.editor

const registerStyle = (style) => {
  const type = 'core/potager-style' + style.char;
  const clazz = 'is-style-potager-' + style.char;
  registerFormatType(type, {
    title: __(style.title),
    tagName: 'span',
    className: clazz,
    edit ({ isActive, value, onChange }) {
      const onToggle = () => onChange(toggleFormat(value, { type }))
      return (
        createElement(Fragment, null,
          createElement(RichTextShortcut, {
            type: 'access',
            character: style.char,
            onUse: onToggle
          }),
          createElement(RichTextToolbarButton, {
            icon: style.icon,
            title: __(style.title),
            onClick: onToggle,
            isActive,
            shortcutType: 'access',
            shortcutCharacter: style.char
          })
        )
      )
    }
  });
};

for (let style of [
      {'char':'1','title':'Potiron','icon':'admin-site'},
      {'char':'2','title':'Potimarron','icon':'marker'},
      {'char':'3','title':'Patidou','icon':'image-filter'}]) {
  registerStyle(style);
}

const { InspectorControls } = window.wp.editor
const { PanelBody, Button } = window.wp.components

const type_remove = 'advanced/remove-formatting'

registerFormatType(type_remove, {
  title: 'Retirer les cucurbitacés',
  tagName: 'span',
  className: 'remove',
  edit ({ isActive, value, onChange }) {
    return (
      createElement(InspectorControls, null,
        createElement(PanelBody, {
          title: 'Retirer les cucurbitacés'
        },
        createElement(Button, {
          isDefault: true,
          onClick: () => onChange({ ...value, formats: Array(value.formats.length) })
        },
        'Retirer les cucurbitacés'
        )
        )
      )
    )
  }
})
