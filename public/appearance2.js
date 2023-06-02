const appearance = {
    theme: 'stripe',
    variables: {
      fontWeightNormal: '500',
      borderRadius: '2px',
      colorPrimary: '#EBA198',
      colorIconTabSelected: '#fff',
      spacingGridRow: '16px'
    },
    rules: {
      '.Tab, .Input, .Block, .CheckboxInput, .CodeInput': {
        boxShadow: '0px 3px 10px rgba(18, 42, 66, 0.08)'
      },
      '.Block': {
        borderColor: 'transparent'
      },
      '.BlockDivider': {
        backgroundColor: '#ebebeb'
      },
      '.Tab, .Tab:hover, .Tab:focus': {
        border: '0'
      },
      '.Tab--selected, .Tab--selected:hover': {
        backgroundColor: '#b46100',
        color: '#fff'
      }
    }
  };