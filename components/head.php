<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_TITLE ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- CDN TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Noto Sans JP"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50:  '#eff8ff',
                            100: '#dbeefe',
                            200: '#bfe0fd',
                            300: '#93cbfb',
                            400: '#60aef7',
                            500: '#3b8ef1',
                            600: '#1a6ee6',
                            700: '#1459cf',
                            800: '#1648a8',
                            900: '#183f84',
                        },
                    },
                }
            }
        }
    </script>
    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.4.0/dist/chartjs-plugin-annotation.min.js"></script>
    <!-- CDN marked.js -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <style>
        body { font-family: 'Noto Sans JP', sans-serif; }
        .kenko-gradient { background: linear-gradient(135deg, #1a6ee6 0%, #22d3ee 100%); }
        .kenko-card {
            transition: box-shadow 0.2s, border-color 0.2s, transform 0.2s;
        }
        .kenko-card:hover {
            transform: translateY(-2px);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.5s ease both; }
        .fade-up-1 { animation-delay: 0.05s; }
        .fade-up-2 { animation-delay: 0.15s; }
        .fade-up-3 { animation-delay: 0.25s; }
    </style>
</head>
