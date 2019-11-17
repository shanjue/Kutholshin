@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table id="example" class="display table" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Position</th>
                <th>Office</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>
                    <input type="text" class="input-age" data-link="input-age-ok-1" id="row-1-age" name="row-1-age" value="61">
                </td>
                <td><input type="text" class="input-position" id="row-1-position" name="row-1-position" value="System Architect"></td>
                <td><select size="1" class="input-office" id="row-1-office" name="row-1-office">
                        <option value="Edinburgh" selected="selected">
                            Edinburgh
                        </option>
                        <option value="London">
                            London
                        </option>
                        <option value="New York">
                            New York
                        </option>
                        <option value="San Francisco">
                            San Francisco
                        </option>
                        <option value="Tokyo">
                            Tokyo
                        </option>
                    </select></td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>
                    <input type="text" class="input-age" data-link="input-age-ok-2" id="row-2-age" name="row-2-age" value="63">
                </td>
                <td>
                    <input type="text" id="row-2-position" data-link="input-link-ok-3" name="row-2-position" value="Accountant">
                </td>
                <td><select size="1" id="row-2-office" name="row-2-office">
                        <option value="Edinburgh">
                            Edinburgh
                        </option>
                        <option value="London">
                            London
                        </option>
                        <option value="New York">
                            New York
                        </option>
                        <option value="San Francisco">
                            San Francisco
                        </option>
                        <option value="Tokyo" selected="selected">
                            Tokyo
                        </option>
                    </select></td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>
                    <input type="text" class="input-age" data-link="input-link-ok-3" id="row-3-age" name="row-3-age" value="66">
                </td>
                <td><input type="text" id="row-3-position" name="row-3-position" value="Junior Technical Author"></td>
                <td><select size="1" id="row-3-office" name="row-3-office">
                        <option value="Edinburgh">
                            Edinburgh
                        </option>
                        <option value="London">
                            London
                        </option>
                        <option value="New York">
                            New York
                        </option>
                        <option value="San Francisco" selected="selected">
                            San Francisco
                        </option>
                        <option value="Tokyo">
                            Tokyo
                        </option>
                    </select></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script>
    var table = $('#example').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [1, 2, 3]
        }]
    });

    var inputAge = document.getElementsByClassName("input-age");
    for (var i = 0; i < inputAge.length; i++) {
        inputAge[i].addEventListener('keyup', function(event) {

            if (event.which === 13) {
                var element = this;
                var value = this.value;
                var body = {
                    "age": value
                }
                var url = '/datatable';
                var some = postRequest(url, body, element);
                console.log(some)


            }
        })


    }

    function postRequest(url = null, body, element) {
        var myHeaders = new Headers();
        myHeaders.append('Content-Type', 'application/json');
        myHeaders.append('X-CSRF-TOKEN', getMeta('csrf-token'))
        const request = new Request(url, {
            method: 'POST',
            headers: myHeaders,
            body: JSON.stringify(body)
        });
        const response = fetch(request)
            .then(response => {
                if (response.status === 200) {
                    response.json().then(res => {
                        if (res['success'] == 'succeed') {
                            return 'submit age succeed'
                        }
                    });

                } else {
                    throw new Error('Something went wrong on api server!');
                }
            })
            .then(response => {
                console.debug(response);
                // ...
            }).catch(error => {
                console.error(error);
            });
        return response;

    }

    function getMeta(metaName) {
        const metas = document.getElementsByTagName('meta');

        for (let i = 0; i < metas.length; i++) {
            if (metas[i].getAttribute('name') === metaName) {
                return metas[i].getAttribute('content');
            }
        }

        return '';
    }
</script>
@endsection