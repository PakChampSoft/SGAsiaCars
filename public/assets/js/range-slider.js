
        $('.range-slider').jRange({
            from: 0,
            to: 50000,
            step: 1000,
            scale: [0, 50000],
            format: 'USD %s',
            width: 150,
            showLabels: true,
            isRange: true,
            onstatechange: function() {
                var vals = $('.range-slider').val();
                var avals = vals.split(',')
                var min = avals[0];
                var max = avals[1];

                $('#min_price').val(min);
                $('#max_price').val(max);
            }
        });
