(function ($) {
    'use strict';

    $(document).ready(function () {
        /*$('#reporting2').DataTable({
            "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": true,
                "responsive": true,
                "fixedHeader": true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fas  fa-print"></i> Imprimer',
                    autoPrint: true,
                    orientation : 'landscape',
                    exportOptions: {
columns: ':visible',
                        stripHtml: true,
                        modifier: {
                            
                            selected: null
                        },
                        
                        format: {
                            body: function ( inner, coldex, rowdex ) {
                              if (inner.length <= 0) return inner;
                              var el = $.parseHTML(inner);
                              var result='';
                              $.each( el, function (index, item) {
                                if (item.nodeName == '#text') result = result + item.textContent;
                                else if (item.nodeName == 'SUP') result = result + item.outerHTML;
                                else if (item.nodeName == 'STRONG') result = result + item.outerHTML;
                                else if (item.nodeName == 'IMG') result = result + item.outerHTML;
                                else result = result + item.innerText;
                              });
                              return result;
                            }
                        }
                    },
                  
                    customize: function (win) {
                        $(win.document.body).find('table').addClass('display').css('font-size', '12px');
                        $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                            $(this).css('background-color','#D0D0D0');
                        });
                        $(win.document.body).find('h1').css('text-align','center');
                    }
                    
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Exporter en Excel'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> Générer en PDF',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    },
                    title : function() {
                        return "ABCDE List";
                    },
                    orientation : 'landscape',
                   // pageSize : 'A4',  You can also use "A1","A2" or "A3", most of the time "A3" works the best.
                    
                }
            ],
            selected: true,
            

            "language": {
                "emptyTable": "Aucune donnée",
                  "info":           " _START_ à _END_ sur _TOTAL_ lignes(s)",
                  "infoEmpty":      "Affichage de 0 à 0 sur 0 ligne(s)",
                  "infoFiltered":   "(filtré de _MAX_ lignes)",
                  "infoPostFix":    "",
                  "thousands":      ",",
                  "lengthMenu":     "Lignes par page _MENU_ ",
                  "loadingRecords": "Chargement encours...",
                  "processing":     "",
                  "search":         "Recherche",
                  "zeroRecords":    "Aucune donnée correspondant au critère de recherche",
                  "paginate": {
                      "first":      "Premier",
                      "last":       "Dernier",
                      "next":       "Suivant",
                      "previous":   "Précédent"
                  } 
                },
        });*/
        $('#table1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "language": {
                "emptyTable": "Aucune donnée",
                "info": " _START_ à _END_ sur _TOTAL_ lignes(s)",
                "infoEmpty": "Affichage de 0 à 0 sur 0 ligne(s)",
                "infoFiltered": "(filtré de _MAX_ lignes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Lignes par page _MENU_ ",
                "loadingRecords": "Chargement encours...",
                "processing": "",
                "search": "Saisissez les critères",
                "zeroRecords": "Aucune donnée correspondant au critère de recherche",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            },
        });
        $('#table1_length select').addClass('form-select form-control');
        $('#table1_filter input').addClass('form-control bg-light text-dark mr-3');
        $('#table1_wrapper .dataTables_filter').find('input').each(function () {
            const $this = $(this);
            $this.attr("placeholder", "Recherche ...");
            //$this.className("form-control form-control-lg");
            //$this.removeClass('form-control-lg bg-light');
        });
    });
}(jQuery));