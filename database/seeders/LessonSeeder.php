<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $grades = Grade::all();
        $classes = ClassModel::all();

        foreach ($grades as $grade) {
            foreach ($classes as $class) {
                $subjects = Subject::inRandomOrder()->limit(4)->get();
                $usedSlots = [];
                foreach ($subjects as $subject) {
                    $teacher = Teacher::where('subject_id', $subject->id)->inRandomOrder()->first();

                    if (!$teacher) {
                        continue;
                    }

                    $foundSlot = false;
                    for ($i = 0; $i < 10; $i++) {


                        $hours = rand(7, 12);
                        $minutes = [0, 15, 30, 45][rand(0, 3)];

                        $start = Carbon::createFromTime($hours, $minutes, 0);
                        $end = (clone $start)->addHour();

                        // Check Tumpang tindih?
                        $overlap = false;
                        foreach ($usedSlots as $usedSlot) {
                            if (
                                $start->between($usedSlot['start'], $usedSlot['end']) ||
                                $end->between($usedSlot['start'], $usedSlot['end']) ||
                                ($start->lte($usedSlot['start']) && $end->gte($usedSlot['end']))
                            ) {
                                $overlap = true;
                                break;
                            }
                        }

                        if (!$overlap) {
                            $usedSlots[] = ['start' => $start, 'end' => $end];
                            $foundSlot = true;
                            break;
                        }
                    }

                    if (!$foundSlot) {
                        continue; // Skip to the next subject if no slot found
                    }

                    Lesson::create([
                        'name' => $grade->level . '-' . $class->name,
                        'grade_id' => $grade->id,
                        'class_id' => $class->id,
                        'subject_id' => $teacher->subject->id,
                        'teacher_id' => $teacher->id,
                        'start' => $start->format('H:i:s'),
                        'end' => $end->format('H:i:s'),
                    ]);
                }
            }
        }
    }
}
