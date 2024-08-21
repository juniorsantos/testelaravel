@extends('layouts.master')
@section('title')
    Inicio
@endsection
@section('content')
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-[580px]">
            <div class="space-y-12 divide-y divide-gray-900/10">
                <form action="javascript:void(0)" id="register-user" method="post" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-2.5 sm:grid-cols-6">

                            <div class="sm:col-span-full">
                                <label for="full_name" class="block text-sm font-medium leading-6 text-gray-900">Nome completo</label>
                                <div class="mt-2">
                                    <input type="text" name="full_name" id="full_name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text full_name_error pt-1" style="color: red"></span>
                            </div>

                            <div class="sm:col-span-full">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text email_error pt-1" style="color: red"></span>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text password_error pt-1" style="color: red"></span>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirme a Senha</label>
                                <div class="mt-2">
                                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="password_confirmation" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text password_confirmation_error pt-1" style="color: red"></span>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="postal_code" class="block text-sm font-medium leading-6 text-gray-900">CEP</label>
                                <div class="mt-2">
                                    <input type="text" name="postal_code" id="postal_code" autocomplete="postal_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text postal_code_error pt-1" style="color: red"></span>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="" class="block text-sm font-medium leading-6 text-gray-900">&nbsp;</label>
                                <div class="mt-3">
                                    <div id="request-postal-code" class="text-center rounded-md bg-green-600 cursor-pointer px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                        Buscar
                                    </div>
                                </div>

                            </div>

                            <div class="col-span-full">
                                <label for="street" class="block text-sm font-medium leading-6 text-gray-900">Rua</label>
                                <div class="mt-2">
                                    <input type="text" name="street" id="street" autocomplete="street" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text street_error pt-1" style="color: red"></span>
                            </div>

                            <div class="col-span-1 sm:col-start-1">
                                <label for="number" class="block text-sm font-medium leading-6 text-gray-900">Número</label>
                                <div class="mt-2">
                                    <input type="text" name="number" id="number" autocomplete="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text number_error pt-1" style="color: red"></span>
                            </div>

                            <div class="col-span-5">
                                <label for="district" class="block text-sm font-medium leading-6 text-gray-900">Bairro</label>
                                <div class="mt-2">
                                    <input type="text" name="district" id="district" autocomplete="district" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text district_error pt-1" style="color: red"></span>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Cidade</label>
                                <div class="mt-2">
                                    <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text city_error pt-1" style="color: red"></span>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="state" class="block text-sm font-medium leading-6 text-gray-900">Estado</label>
                                <div class="mt-2">
                                    <input type="text" name="state" id="state" autocomplete="state" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <span class="text-danger error-text state_error pt-1" style="color: red"></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("#request-postal-code").click(function() {

            let postalCode = $("#postal_code").val()
            $.ajax({
                url: "{{ url('') }}/postal-code/"+postalCode,
                type: 'GET',
                dataType: "json",
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    $("#city").val(response.data.localidade)
                    $("#state").val(response.data.uf)
                    $("#street").val(response.data.logradouro)
                    $("#district").val(response.data.bairro)
                },
                error: function (error) {
                    if (error.status === 422) {
                        let data = JSON.parse(error.responseText);
                        $('span.postal_code_error').text(data.message);
                    }
                }
            });
        });

        $("#register-user").validate({
            submitHandler: function() {
                $.ajax({
                    url: "{{ route('auth.register') }}",
                    type: 'POST',
                    dataType: "json",
                    data: $("#register-user").serialize(),
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function (error) {
                        if (error.status === 422) {
                            let data = JSON.parse(error.responseText);
                            $.each(data.errors, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }
                    }
                });
            }
        });
    </script>
@endsection
