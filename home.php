<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLife - Your Fitness Journey Starts Here</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Hero Section</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="relative h-screen overflow-hidden">
        <!-- Video Background -->
        <video 
            class="absolute top-0 left-0 w-full h-full object-cover"
            autoplay 
            muted 
            loop 
            playsinline
        >
            <source src="/api/placeholder/1920/1080" type="video/mp4">
        </video>

        <!-- Gradient Overlay with enhanced depth -->
        <div class="absolute inset-0 bg-gradient-to-r from-purple-900/95 via-purple-800/90 to-indigo-800/85 backdrop-blur-sm"></div>

        <!-- Animated particles overlay for depth (optional) -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white/5 via-transparent to-transparent"></div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 py-32 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="text-white max-w-2xl animate-fade-in">
                <span class="inline-block px-4 py-1 bg-white/10 backdrop-blur-md rounded-full text-sm font-medium mb-6">
                    TRANSFORM YOUR LIFE
                </span>
                <h1 class="text-6xl font-bold mb-6 leading-tight">
                    Transform Your Body,
                    <br/>
                    <span class="bg-gradient-to-r from-purple-200 to-indigo-200 text-transparent bg-clip-text">
                        Transform Your Life
                    </span>
                </h1>
                <p class="text-xl mb-8 text-gray-200 leading-relaxed max-w-xl">
                    Join our community of fitness enthusiasts and achieve your goals with expert-led workouts and personalized training plans.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#programs" 
                       class="group bg-white text-purple-900 px-8 py-4 rounded-full font-semibold hover:bg-purple-100 transition-all transform hover:-translate-y-0.5 hover:shadow-lg hover:shadow-purple-500/20 flex items-center">
                        Get Started Today
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="#watch-demo" 
                       class="group px-8 py-4 rounded-full font-semibold border border-white/20 hover:bg-white/10 transition-all flex items-center">
                        Watch Demo
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </a>
                </div>

                <!-- Quick Stats -->
                <div class="mt-16 grid grid-cols-3 gap-8 border-t border-white/10 pt-8">
                    <div>
                        <div class="text-3xl font-bold mb-1">500+</div>
                        <div class="text-gray-300">Workout Videos</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-1">50k+</div>
                        <div class="text-gray-300">Active Members</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-1">98%</div>
                        <div class="text-gray-300">Success Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
    </style>
</body>
</html>

    <!-- Programs Section -->
    <section id="programs" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16">Our Programs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php include 'includes/programs.php'; ?>
            </div>
        </div>
    </section>

    <!-- Classes Schedule -->
    <section class="bg-purple-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16">Today's Classes</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <?php include 'includes/schedule.php'; ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html>