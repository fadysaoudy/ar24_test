@extends('layouts.app')

@section('user_form')

    <div class="container w-50">
        <form class="mx-auto my-5">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" disabled id="firstname" value="{{$user->firstname}}">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" disabled id="lastname" value="{{$user->lastname}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email </label>
                <input type="text" class="form-control" disabled id="email" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender </label>
                <input type="text" class="form-control" disabled id="gender"
                       value="{{$user->gender =='F'?'Female':'Male'}}">
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">Status </label>
                <input type="text" class="form-control" disabled id="statut" value="{{$user->statut}}">
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company Name</label>
                <input type="text" class="form-control" disabled id="company" value="{{$user->company}}">
            </div>
            <div class="mb-3">
                <label for="company_siret" class="form-label">Company SIRET</label>
                <input type="text" class="form-control" disabled id="company_siret" value="{{$user->company_siret}}">
            </div>
            <div class="mb-3">
                <label for="company_tva" class="form-label">Company TVA</label>
                <input type="text" class="form-control" disabled id="company_tva" value="{{$user->company_tva}}">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country </label>
                <input type="text" class="form-control" disabled id="country" value="{{$user->country}}">
            </div>
            <div class="mb-3">
                <label for="address1" class="form-label">Address Line 1 </label>
                <input type="text" class="form-control" disabled id="address1" value="{{$user->address1}}">
            </div>
            <div class="mb-3">
                <label for="address2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control" disabled id="address2" value="{{$user->address2}}">
            </div>
            <div class="mb-3">
                <label for="zipcode" class="form-label">Zipcode</label>
                <input type="text" class="form-control" disabled id="zipcode" value="{{$user->zipcode}}">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" disabled id="city" value="{{$user->city}}">
            </div>
            <div class="mb-3">
                <label for="confirmed" class="form-label">Ask email confirmation</label>
                <input type="text" class="form-control" disabled id="confirmed"
                       value="{{$user->confirmed == 1 ? 'Yes' : 'No'}}">
            </div>

            <div class="mb-3">
                <label for="cgu" class="form-label">Confirm user has accepted AR24 Terms and Conditions</label>

                <input type="text" class="form-control" disabled id="cgu" name="cgu"
                       value="{{$user->cgu == 1 ? 'Yes' : 'No'}}">
            </div>

            <div class="mb-3">
                <label for="notify_ev" class="form-label">Send "submission and initial presentation"
                    notifications</label>
                <input type="text" class="form-control" disabled id="notify_ev" name="notify_ev"
                       value="{{$user->notify_ev == 1 ? 'Yes' : 'No'}}">
            </div>

            <div class="mb-3">
                <label for="notify_ar" class="form-label">Send "reception" notifications</label>
                <input type="text" class="form-control" disabled id="notify_ar" name="notify_ar"
                       value="{{$user->notify_ar == 1 ? 'Yes' : 'No'}}">
            </div>

            <div class="mb-3">
                <label for="notify_rf" class="form-label">Send "refusal" notifications</label>
                <input type="text" class="form-control" disabled id="notify_rf" name="notify_rf"
                       value="{{$user->notify_rf == 1 ? 'Yes' : 'No'}}">

            </div>

            <div class="mb-3">
                <label for="notify_ng" class="form-label">Send "negligence" notifications</label>
                <input type="text" class="form-control" disabled id="notify_ng" name="notify_ng"
                       value="{{$user->notify_ng == 1 ? 'Yes' : 'No'}}">
            </div>

            <div class="mb-3">
                <label for="notify_consent" class="form-label">Send "consent" notifications</label>
                <input type="text" class="form-control" disabled id="notify_consent" name="notify_consent"
                       value="{{$user->notify_consent == 1 ? 'Yes' : 'No'}}">

            </div>

            <div class="mb-3">
                <label for="notify_eidas_to_valid" class="form-label">Send notification to valid eIDAS from team</label>
                <input type="text" class="form-control" disabled id="notify_eidas_to_valid"
                       name="notify_eidas_to_valid" value="{{$user->notify_eidas_to_valid == 1 ? 'Yes' : 'No'}}">

            </div>

            <div class="mb-3">
                <label for="notify_recipient_update" class="form-label">Send notification when a recipient update is
                    created</label>
                <input type="text" class="form-control" disabled id="notify_recipient_update"
                       value="{{$user->notify_recipient_update == 1 ? 'Yes' : 'No'}}"
                       name="notify_recipient_update">

            </div>

            <div class="mb-3">
                <label for="notify_waiting_ar_answer" class="form-label">Send twice a week a list of waiting
                    sending</label>
                <input type="text" class="form-control" disabled id="notify_waiting_ar_answer"
                       value="{{$user->notify_waiting_ar_answer == 1 ? 'Yes' : 'No'}}"
                       name="notify_waiting_ar_answer">
            </div>

            <div class="mb-3">
                <label for="is_legal_entity" class="form-label">Legal Entity</label>
                <input type="text" class="form-control" disabled id="is_legal_entity" name="is_legal_entity"
                       value="{{$user->is_legal_entity  ? 'Yes' : 'No'}}">
            </div>
@dump($user->id)
        </form>
    </div>
@endsection
