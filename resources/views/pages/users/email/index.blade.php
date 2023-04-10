@extends('layouts.app')
@section('send_email_form')
    <div class="container w-50">

        <form class="mx-auto my-5" method="POST" action="{{ route('email.store') }}"  enctype="multipart/form-data">
            @CSRF
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="form-group pb-4">
                <label class="form-label" for="eidas">eIDAS Mail</label>
                <select class="form-control" id="eidas" name="eidas" required>
                    <option value=""></option>
                    <option value="1">Yes, eIDAS Mail</option>
                    <option value="0">No, Registered Mail</option>
                </select>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="custom_name_sender">Custom Sender Name</label>
                <input type="text" class="form-control" id="custom_name_sender" name="custom_name_sender"/>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="to_lastname">Recipient's Last Name</label>
                <input type="text" class="form-control" id="to_lastname" name="to_lastname"/>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="to_firstname">Recipient's First Name</label>
                <input type="text" class="form-control" id="to_firstname" name="to_firstname" />
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="to_company">Recipient's Company</label>
                <input type="text" class="form-control" id="to_company" name="to_company"/>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="to_email">Recipient's Email</label>
                <input type="email" class="form-control" id="to_email" name="to_email" required/>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="dest_statut">Recipient's Status</label>
                <select class="form-control" id="dest_statut" name="dest_statut" required>
                    <option value=""></option>
                    <option value="particulier">Particulier</option>
                    <option value="professionnel">Professionnel</option>
                </select>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="content">Mail Content</label>
                <textarea class="form-control" id="content" name="content" ></textarea>
                <small class="form-text text-muted">Please note: Only plain text or HTML allowed. No external resources allowed. Only base64-encoded images.</small>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="ref_dossier">Document Reference</label>
                <input type="text" class="form-control" id="ref_dossier" name="ref_dossier"/>
            </div>
            <div class="form-group pb-4">
                <label class="form-label" for="ref_client">Client Reference</label>
                <input type="text" class="form-control" id="ref_client" name="ref_client"/>
            </div>
            <div class="form-group pb-4">
                <label class="form-label" for="ref_facturation">Facturation Reference</label>
                <input type="text" class="form-control" id="ref_facturation" name="ref_facturation"/>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="attachment">Attachments</label>
                <input type="text" class="form-control" id="attachment" name="attachment" placeholder="Enter attachment IDs separated by commas"/>
            </div>

            <div class="form-group pb-4">
                <label class="form-label" for="payment_slug">Facturation Reference</label>
                <input type="text" class="form-control" id="payment_slug" name="payment_slug"/>
            </div>
            <div class="form-group pb-4">
                <label class="form-label" for="ref_dossier">Case Reference</label>
                <input type="text" class="form-control" id="ref_dossier" name="ref_dossier"/>
            </div>
            <div class="form-group pb-4">
                <label class="form-label" for="webhook">Webhook URL</label>
                <input type="text" class="form-control" id="webhook" name="webhook" placeholder="Enter the webhook URL"/>
            </div>

            <div class="form-group pb-4">
                <label for="pre_notif">Send pre-notification:</label>
                <input type="checkbox" id="pre_notif" name="pre_notif" value="1">
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection
