function parseDate(input) {
  var parts = input.match(/(\d+)/g);
  return new Date(parts[2], parts[1]-1, parts[0]);
}

function next(i)
{
	i--;
	var id = document.getElementById("id_row" + i).innerText;
	var date = document.getElementById("date_row" + i).innerText;
	var action = "next";
	var form_data = new FormData();

	form_data.append('id', id);
	form_data.append('date', date);
	form_data.append('action', action);

	$.ajax({
        url: 'get_orders.php',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(h){
        	h = JSON.parse(h);
            var j;

            if (h.length < 10)
            {
            	for (j = h.length; j < 10; j++)
            	{
            		document.getElementById('order_row' + j).style.visibility='hidden';
            		document.getElementById('next').style.visibility='hidden';
            	}
            }

            for (j = 0; j < h.length; j++)
            {
            	document.getElementById("id_row" + j).innerText = h[j]["order_id"];
            	document.getElementById("date_row" + j).innerText = h[j]["created"];
            	document.getElementById("sum_row" + j).innerText = h[j]["summ"] + " руб.";
            }
            document.getElementById('previous').style.visibility='visible';
        }
   	});
}

function previous(i)
{
	i--;
	var id = document.getElementById("id_row0").innerText;
	var date = document.getElementById("date_row0").innerText;
	var action = "prev";
	var form_data = new FormData();

	date = parseDate(date);
	date = date.setDate(date.getDate() + 1);
	date = new Date(date);
	date = ("0" + date.getDate()).slice(-2) + "." + ("0" + (date.getMonth() + 1)).slice(-2) + "." + date.getFullYear();

	form_data.append('id', id);
	form_data.append('date', date);
	form_data.append('action', action);

	$.ajax({
        url: 'get_orders.php',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(h) {
        	h = JSON.parse(h);

        	if (h[0]["order_id"] == 519)
        	{
        		document.getElementById('previous').style.visibility='hidden';
        	}
            for (var j = 0; j < h.length; j++)
            {
				document.getElementById('order_row' + j).style.visibility = 'visible';
            	document.getElementById("id_row" + j).innerText = h[j]["order_id"];
            	document.getElementById("date_row" + j).innerText = h[j]["created"];
            	document.getElementById("sum_row" + j).innerText = h[j]["summ"] + " руб.";
            }
            document.getElementById('next').style.visibility='visible';
        }
   	});
}