module.exports = {

    screens: {
        sm: '640px',
        md: '768px',
        lg: '1024px',
        xl: '1280px',
    },

    fontFamily: {
        display: ['Titillium Web', 'Helvetica', 'Arial', 'Lucida', 'sans-serif'],
        body: ['Titillium Web', 'Helvetica', 'Arial', 'Lucida', 'sans-serif'],
    },

    borderWidth: {
        default: '1px',
        '0': '0',
        '2': '2px',
        '4': '4px',
    },

    theme: {

        colors: {

            white: '#FFFCF5',
            whitewhite: '#FFFFFF',
            black: '#000000',

            brand: {
                anvil: '#DCDFE5',
                brick: '#522A27',
                mahogany: '#9E4634',
                clay: '#A65646',
                sunflower: '#E08E45'
            }

        }

    },

    extend: {

        colors: {
            cyan: '#9cdbff',
        },

        spacing: {
            '96': '24rem',
            '128': '32rem',
        }

    }

};