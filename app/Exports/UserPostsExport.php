<?php

namespace App\Exports;

use App\Models\UserPosts;
use Hamcrest\Type\IsObject;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;


class UserPostsExport implements FromCollection, WithHeadings, WithDrawings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $drawings = [];


    public function collection()
    {
        $query = UserPosts::with(['category', 'user']);

        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }

        $posts = $query->get();
        $exportData = [];
        $i = 1;

        foreach ($posts as $post) {
            if ($post->image_path) {
                $drawing = new Drawing;
                $drawing->setName('Post Image');
                $drawing->setDescription('Post Description');
                $drawing->setPath(public_path('storage/' . $post->image_path));
                $drawing->setHeight(100);
                $drawing->setWidth(100);
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawing->setCoordinates('F' . ($i + 1));

                $this->drawings[] = $drawing;
            }

            $exportData[] = [
                'no' => $i,
                'id' => auth()->user()->is_admin ? $post->id : '',
                'user_id' => auth()->user()->is_admin ? $post->user_id : '',
                'title' => $post->title ?? 'N/A',
                'description' => $post->description ?? 'N/A',
                'image' => $post->image_path ? '' : 'No image',
                'category' => $post->category->name ?? 'Uncategorized',
                'created_at' => $post->created_at->format('Y-m-d H:i'),
                'updated_at' => $post->updated_at->format('Y-m-d H:i')
            ];
            $i++;
        }

        return collect($exportData);
    }



    public function headings(): array
    {
        return [
            'No',
            auth()->user()->is_admin ? 'Post ID' : '',
            auth()->user()->is_admin ? 'User_ID' : '',
            'Title',
            'Description',
            'Image',
            'Category',
            'Creation Date',
            'Last Updated At'
        ];
    }

    public function drawings()
    {
        return $this->drawings;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setWidth(5);    // No. column
        $sheet->getColumnDimension('B')->setWidth(10);   // ID column (if visible)
        $sheet->getColumnDimension('C')->setWidth(10);   // User ID column (if visible)
        $sheet->getColumnDimension('D')->setWidth(25);   // Title column
        $sheet->getColumnDimension('E')->setWidth(40);   // Description column
        $sheet->getColumnDimension('F')->setWidth(15);   // Image column
        $sheet->getColumnDimension('G')->setWidth(15);   // Category column
        $sheet->getColumnDimension('H')->setWidth(20);   // Created At column
        $sheet->getColumnDimension('I')->setWidth(20);   // Updated At column

        // Set all rows to a reasonable default height
        $sheet->getDefaultRowDimension()->setRowHeight(20); // Default height

        // Set specific height for rows with images
        foreach ($this->drawings as $index => $drawing) {
            $rowNumber = $index + 2;
            $sheet->getRowDimension($rowNumber)->setRowHeight(120); // Slightly less than image height
        }

        $sheet->getStyle('A2:I' . ($sheet->getHighestRow()))
            ->applyFromArray([
                'alignment' => [
                    'wrapText' => true,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ]);

        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ]);

        return [];
    }
}
