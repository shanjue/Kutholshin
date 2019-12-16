<!-- Trix -->
@if($type == 'trix')
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('/backend/css/trix.css')}}">
<style>
    .custom-error-style {
        font-weight: bold;
        color: #dc3545;
        font-size: 80%
    }
</style>
@if(isset($required))
@if($required == true)
<style>
    .is-invalid-trix {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
        background-repeat: no-repeat;
        background-position: center right calc(0.375em + 0.1875rem);
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
</style>
@endif
@endif
@endpush

@push('js')
<script type="text/javascript" src="{{asset('/backend/js/trix.js')}}"></script>
@if(isset($required))
@if($required == true)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var submitButton = document.querySelector('button[type="submit"]');
        var allHiddenInputs = document.querySelectorAll('input[type="hidden"]');
        var allTrixEditors = document.querySelectorAll('trix-editor')


        submitButton.addEventListener('click', function(event) {
            for (let i = 0; i < allHiddenInputs.length; i++) {
                if (allHiddenInputs[i].value == '') {
                    var className = allHiddenInputs[i].name
                    //to change border color red
                    for (let i = 0; i < allTrixEditors.length; i++) {
                        var trixName = allTrixEditors[i].getAttributeNode('input').value;
                        if (trixName == className) {
                            allTrixEditors[i].setAttribute('class', 'is-invalid-trix')
                        }
                    }

                    //show span alert message
                    var spanAlert = document.getElementsByClassName(className);
                    spanAlert[0].style.display = 'block'
                    event.preventDefault()
                } else {
                    var className = allHiddenInputs[i].name
                    //to change border color red
                    for (let i = 0; i < allTrixEditors.length; i++) {
                        var trixName = allTrixEditors[i].getAttributeNode('input').value;
                        if (trixName == className) {
                            allTrixEditors[i].removeAttribute('class', 'is-invalid-trix')
                        }
                    }
                    //show span alert message
                    var spanAlert = document.getElementsByClassName(className);
                    if (spanAlert.length != 0) {
                        spanAlert[0].style.display = 'none'
                    }

                }


            }

        })
    })
</script>
@endif
@endif
@endpush
@endif
<!-- End Trix -->

<!-- Calendar -->
@if($type == 'calendar')
@push('css')
<link rel="stylesheet" href="/backend/css/date-picker.min.css">
@endpush
@push('js')
<script src="/backend/js/date-picker.min.js"></script>
<script>
    $(function() {

        //Date picker
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
@endpush
@endif
<!-- End Calendar -->