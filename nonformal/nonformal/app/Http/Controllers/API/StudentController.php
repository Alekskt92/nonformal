<?php

namespace App\Http\Controllers\API;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class StudentController extends BaseController
{
    /**
     * Returns the student by his uuid
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validateInputKeys($request);

        $student_uuid = $request->student_uuid;

        $student = $this->getStudent($student_uuid);


        $student = $student->with('groupStudent')->first();

        /*$studentInfo = [
            'name' => $student->name,
            'last_name' => $student->last_name,
            'patronymic' => $student->patronymic,
            'student_uuid' => $student->student_uuid,
            'name_group' => $student->groupStudent !== null ? $student->groupStudent->name_group : null,
        ];*/
        return $this->sendResponse($student->toArray(), 'Student found successfully!');
    }


    /**
     * update info about student
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validateInputKeys($request);

        $student_uuid = $request->student_uuid;

        $student = $this->getStudent($student_uuid);

        $student = $student->with('groupStudent')->first();
        $student->fill($request->all());

        $student->groupStudent->fill($request->all());
        $student->groupStudent->save();
        $student->save();


        return $this->sendResponse($student->toArray(), 'Student found successfully!');
    }

    /**
     * validate input data
     * @param Request $request
     * @return bool|\Illuminate\Http\Response
     */
    protected function validateInputKeys(Request $request)
    {
        if (!$request->has('student_uuid') || empty($request->student_uuid))
        {
            return $this->sendError('Empty required parameters!');
        }

        $validator = Validator::make($request->all(), [
            'student_uuid' => 'uuid',
            'name' => 'string|max:50',
            'last_name' => 'string|max:50',
            'patronymic' => 'string|max:50',
            'group_uuid' => 'uuid',
        ]);

        if ($validator->fails()) {
            $this->sendError('Validation Error.', $validator->errors());
            return exit();
        }
        return true;
    }


    /**
     * @param string $student_uuid
     * @return \Illuminate\Http\Response|null|mixed
     */
    protected function getStudent($student_uuid)
    {
        $student = null;

        if (!empty($student_uuid)){
            $student = Student::where('student_uuid', $student_uuid);
        }else{
            $this->sendError('Something went wrong :/');
            return exit();
        }

        if ($student === null || $student->first() === null) {
            $this->sendError('Student not found.');
            return exit();
        }
        return $student;
    }

}
