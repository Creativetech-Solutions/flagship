$.fn.dataTableExt.afnFiltering.push(
	function( oSettings, aData, iDataIndex ) {
		if ($('#min').val() == '' && $('#max').val() == '') {
			return true;
		}

		if ($('#min').val() != '' || $('#max').val() != '') {
			var iMin_temp = $('#min').val();
			
			if (iMin_temp == '') {
			  iMin_temp = '01/01/2000';
			}
			
			var iMax_temp = $('#max').val();
			
			if (iMax_temp == '') {
			  iMax_temp = '31/12/2999'
			}
			
			var arr_min = iMin_temp.split("/");
			var arr_max = iMax_temp.split("/");

			// aData[column with dates]
			// 4 is the column where my dates are. Just replace it according to your needs. First column is 0.
			var arr_date = aData[4].split("/"); 
  			var iMin = new Date(arr_min[2], arr_min[0], arr_min[1], 0, 0, 0, 0)
			var iMax = new Date(arr_max[2], arr_max[0], arr_max[1], 0, 0, 0, 0)
			var iDate = new Date(arr_date[2], arr_date[0], arr_date[1], 0, 0, 0, 0)
			
			if ( iMin == "" && iMax == "" )
			{
				return true;
			}
			else if ( iMin == "" && iDate < iMax )
			{
				return true;
			}
			else if ( iMin <= iDate && "" == iMax )
			{
				return true;
			}
			else if ( iMin <= iDate && iDate <= iMax )
			{
				return true;
			}
			return false;
		}
	}
);



