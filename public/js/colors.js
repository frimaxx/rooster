var colors = [
    {
        color: '#cce6ff',
        textColor: '#000'
    },
    {
        color: '#e6e6ff',
        textColor: '#000'
    },
    {
        color: '#e6ffee',
        textColor: '#000'
    },
    {
        color: '#ffe6e6',
        textColor: '#000'
    },
    {
        color: '#ffe6cc',
        textColor: '#000'
    },
    {
        color: '#ffffe6',
        textColor: '#000'
    },
    {
        color: '#cce6ff',
        textColor: '#000'
    },
    {
        color: '#cceeff',
        textColor: '#000'
    },
    {
        color: '#f2e6d9',
        textColor: '#000'
    },
    {
        color: '#ffd6cc',
        textColor: '#000'
    },
    {
        color: '#ffe6ff',
        textColor: '#000'
    },
    {
        color: '#f2d9e6',
        textColor: '#000'
    }
];

for(var i = 0; i < users.length; i++) {
    users[i].color = colors[i].color;
    users[i].textColor = colors[i].textColor;
    $('#user_'+users[i].user_id).css('background', users[i].color).css('color', users[i].textColor).css('border-color', users[i].color);
}

var looped = 0;
function getColorsByUserid(user_id) {
    start = looped * 12;
    for (var i = 0; i < users.length; i++) {
        if (users[i].user_id === user_id) {
            if (i % 12) {
                looped++;
            }
            return {
                color: users[i].color,
                textColor: users[i].textColor
            }
        }
    }
    return false;
}