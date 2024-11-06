<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Numbered Text</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="w-full max-w-4xl mx-auto p-4">
        <div class="border rounded-lg bg-white overflow-hidden shadow-sm">
            <div class="font-mono text-sm leading-relaxed whitespace-pre-wrap p-4">
                @php
                    $text = "At the start of the twentieth century, formal education gained greater significance in the United States. With the frontier mostly gone by 1910 and most Americans living in towns and cities, industrialization and a new focus on credentials made education increasingly vital for economic and social advancement. Schools were also seen as the most significant means for integrating immigrants into American society.

The arrival of many southern and eastern European immigrants around this time led to a significant expansion in formal schooling. By 1920, most states had made schooling until at least age fourteen compulsory, and the school year was extended. Public schools increasingly influenced students' lives through kindergartens, vacation schools, extracurricular activities, vocational education, and counseling. They also offered classes for adult immigrants, with support from schools, corporations, unions, churches, settlement houses, and other organizations";

                    $lines = array_filter(explode("\n", $text), function ($line) {
                        return trim($line) !== '';
                    });
                @endphp

                @foreach ($lines as $index => $line)
                    <div class="flex gap-4 hover:bg-gray-100">
                        <span class="text-gray-400 select-none w-8 text-right">
                            {{ $index + 1 }}
                        </span>
                        <span class="flex-1">{{ $line }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
