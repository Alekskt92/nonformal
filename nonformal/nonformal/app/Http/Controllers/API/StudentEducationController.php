<?php

namespace App\Http\Controllers\API;

use App\Student;
use App\StudentEducation;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;


class StudentEducationController extends BaseController
{
    /**
     * Returns the additional education of a student by his uuid or uuid of education
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validateInputKeys($request);

        $studentEducationUuid = $request->student_education_uuid;
        $studentUuid = $request->student_uuid;

        $studentEducation = $this->getStudentEducation($studentEducationUuid, $studentUuid);

        $studentEducation = $studentEducation->with('student')->first();


        /*$studentInfo = [
            'type_education' => $studentEducation->type_education,
            'sphere_education' => $studentEducation->sphere_education,
            'duration' => $studentEducation->duration,
            'duration_type' => $studentEducation->duration_type,
            'diploma' => $studentEducation->diploma,
            'student_education_uuid' => $studentEducation->student->student_education_uuid,
        ];*/
        return $this->sendResponse($studentEducation->toArray(), 'Student found successfully!');
    }

    /**
     * update info about additional education
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validateInputKeys($request);

        $studentEducationUuid = $request->student_education_uuid;
        $studentUuid = $request->student_uuid;

        $studentEducation = $this->getStudentEducation($studentEducationUuid, $studentUuid);

        $studentEducation = $studentEducation->with('student')->first();

        $studentEducation->fill($request->all());

        $studentEducation->save();


//        dd($studentEducation);
        return $this->sendResponse($studentEducation->toArray(), 'Student found successfully!');
    }

    /**
     * validate input data
     * @param Request $request
     * @return bool|\Illuminate\Http\Response
     */
    protected function validateInputKeys(Request $request)
    {
        if (!$request->has('student_education_uuid') || empty($request->student_education_uuid)) {
            return $this->sendError('Empty required parameters!');
        }

        $validator = Validator::make($request->all(), [
            'student_education_uuid' => 'uuid',
            'student_uuid' => 'uuid',
            'type_education' => 'string|max:50',
            'sphere_education' => 'string|max:50',
            'duration' => 'int',
            'duration_type' => 'string|max:15',
            'diploma' => 'boolean',
        ]);

        if ($validator->fails()) {

            $this->sendError('Validation Error.', $validator->errors());
            return false;
        }
        return true;
    }


    /**
     * @param string $studentEducationUuid
     * @param string $studentUuid
     * @return \Illuminate\Http\Response|null|mixed
     */
    protected function getStudentEducation($studentEducationUuid, $studentUuid)
    {
        $student = null;

        if (!empty($studentEducationUuid)) {

            $studentEducation = StudentEducation::where('student_education_uuid', $studentEducationUuid);

        } elseif (!empty($studentUuid)) {

            $student = Student::where('student_uuid', $studentUuid)->first();

            if ($student === null) {
                $this->sendError('Student not found.');
                return exit();
            }

            $studentEducation = StudentEducation::where('student_uuid', $student->student_uuid);

        } else {

            $this->sendError('Something went wrong :/');
            return exit();
        }

        if ($studentEducation === null || $studentEducation->first() === null) {

            $this->sendError('Student not found.');
            return exit();
        }

        return $studentEducation;
    }
}
