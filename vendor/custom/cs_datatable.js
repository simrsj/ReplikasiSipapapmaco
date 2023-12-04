var table = $("#dataTable").DataTable();

//hilangkan colom table
$("a.toggle-vis").on("click", function (e) {
  e.preventDefault();

  // Get the column API object
  var column = table.column($(this).attr("data-column"));

  // Toggle the visibility
  column.visible(!column.visible());
});

//inisiasi baris tag tfoot td th
$("#table-search-each tfoot tr th").each(function () {
  var title = $(this).text();
  $(this).html(
    '<input class="form-control" type="text" placeholder="Cari ' +
      title +
      '" />'
  );
});

//inisiasi baris search
var table = $("#table-search-each").DataTable({
  // processing: true,
  // scrollX: true,
  initComplete: function () {
    // Apply the search
    this.api()
      .columns()
      .every(function () {
        var that = this;

        $("input", this.footer()).on("keyup change clear", function () {
          if (that.search() !== this.value) {
            that.search(this.value).draw();
          }
        });
      });
  },
});

//pindah baris tfoot k header
$("#table-search-each tfoot tr").appendTo("#table-search-each thead");
