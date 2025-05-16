<?php

namespace App\Exports;

use App\Models\UserPosts;
use Hamcrest\Type\IsObject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UserPostsExport implements FromCollection, WithHeadings, WithDrawings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $postWithImages;
    
    public function __construct()
    {
        $this->postWithImages = UserPosts::with('category')->get();      
    }

    public function collection()
    {
        $exportData = [];
        $i = 1;

        foreach ($this->postWithImages as $post){
            if(!is_object($post)){
                continue;
            }

            if($post->image_path == null){
                $checkImage = 'No image';
            } else {
                $checkImage = null;
            }

            $exportData[] = [
                'no' => $i,
                'id' => $post->id,
                'title' => $post->title ?? 'N/A',
                'description' => $post->description ?? 'N/A',
                'image_path' =>$checkImage,
                'category' => $post->category->name ?? 'Uncategorized',
                'created_at' => $post->created_at->format('Y-m-d H:i'),
                'updated_at' => $post->updated_at->format('Y-m-d H:i')
            ];
            $i++;
        }

        return collect($exportData);
    }

    public function headings(): array{
        return [
            'No',
            'Post ID',
            'Title',
            'Description',
            'Image',
            'Category',
            'Creation Date',
            'Last Updated At'
        ];
    }

    

    public function drawings(){
        $drawings = [];
        $row = 2;

        foreach($this->postWithImages as $post)
            if (!empty($post['image_path'])){
                $drawing = new Drawing;
                $drawing -> setName('Post Image');
                $drawing -> setDescription('Post Description');
                $drawing -> setPath(storage_path('app/public/posts/' . basename($post['image_path'])));
                $drawing -> setHeight(100);
                $drawing -> setWidth(100);
                $drawing -> setOffsetX(5);
                $drawing -> setOffsetY(5);
                $drawing -> setCoordinates('E'. $row);

                $drawings[] = $drawing;
                $row++;

            }
        
            return $drawings;
    }

    public function styles(Worksheet $sheet){
        $sheet->getDefaultRowDimension()->setRowHeight(17);

        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);

        $highestRow = $sheet->getHighestRow();

        for($row=2; $row <= $highestRow; $row++){
            if ($sheet->getCell('E'. $row)->getValue() == null){
                $sheet->getRowDimension($row)->setRowHeight(120);
            }
        }
    }
}
