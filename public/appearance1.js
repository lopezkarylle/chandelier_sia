// Helper for displaying status messages.
const addMessage = (message) => {
    const messagesDiv = document.querySelector('#messages');
    messagesDiv.style.display = 'block';
    const messageWithLinks = addDashboardLinks(message);
    messagesDiv.innerHTML += `> ${messageWithLinks}<br>`;
    console.log(`Debug: ${message}`);
  };
  
  // Adds links for known Stripe objects to the Stripe dashboard.
  const addDashboardLinks = (message) => {
    const piDashboardBase = 'https://dashboard.stripe.com/test/payments';
    return message.replace(
      /(pi_(\S*)\b)/g,
      `<a href="${piDashboardBase}/$1" target="_blank">$1</a>`
    );
  };
  
const appearance = {
    theme: 'none',
    variables: {
      fontFamily: 'Verdana',
      fontLineHeight: '1.5',
      borderRadius: '0'
    },
    rules: {
      '.Input, .CheckboxInput, .CodeInput': {
        boxShadow: 'inset -1px -1px #ffffff, inset 1px 1px #0a0a0a, inset -2px -2px #dfdfdf, inset 2px 2px #808080'
      },
      '.Input--invalid': {
        color: '#DF1B41'
      },
      '.Tab, .Block, .PickerItem--selected': {
        backgroundColor: '#dfdfdf',
        boxShadow: 'inset -1px -1px #0a0a0a, inset 1px 1px #ffffff, inset -2px -2px #808080, inset 2px 2px #dfdfdf'
      },
      '.Tab:hover': {
        backgroundColor: '#eee'
      },
      '.Tab--selected, .Tab--selected:focus, .Tab--selected:hover': {
        backgroundColor: '#ccc'
      },
      '.PickerItem': {
        backgroundColor: '#dfdfdf',
        boxShadow: 'inset -1px -1px #0a0a0a, inset 1px 1px #ffffff, inset -2px -2px #808080, inset 2px 2px #dfdfdf'
      },
      '.PickerItem:hover': {
        backgroundColor: '#eee'
      },
      '.PickerItem--highlight': {
        outline: '1px solid blue'
      },
      '.PickerItem--selected:hover': {
        backgroundColor: '#dfdfdf'
      }
    }
  };