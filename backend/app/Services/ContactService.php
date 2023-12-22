<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{

    /**
     * This service doesn't includes try catch blocks due to the exceptions handling being done in the controller.
     * This is due to the simplicity of the project, and to avoid unnecessary and/or duplicated code.
     */

    /**
     * Return the list of contacts of the current user.
     * @return array
     */
    public function list()
    {
        $userId = auth()->user()->id;
        return Contact::where('user_id', $userId)->get();
    }

    /**
     * Create a new contact for the current user, given the specified information.
     * @param array $data
     * @return Contact
     */
    public function create($data)
    {
        $userId = auth()->user()->id;
        $data['user_id'] = $userId;

        return Contact::create($data);
    }

    /**
     * Update the contact specified by id.
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        $userId = auth()->user()->id;
        $contact = Contact::firstWhere(['id' => $id, 'user_id' => $userId]);

        if (!$contact) {
            // If the user is not the owner, they don't need to know if the contact exists or not.
            abort(404, 'Contact not found');
        }

        return $contact->update($data);
    }

    /**
     * Remove the contact specified by id.
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $userId = auth()->user()->id;
        $contact = Contact::firstWhere(['id' => $id, 'user_id' => $userId]);

        if (!$contact) {
            // If the user is not the owner, they don't need to know if the contact exists or not.
            abort(404, 'Contact not found');
        }

        return $contact->delete();
    }
}
