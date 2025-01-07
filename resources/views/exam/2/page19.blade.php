 <style>
     /* Custom scrollbar for modern look */
     .scrollable {
         overflow-y: auto;
         height: 600px;
         /* Adjust as needed */
     }

     /* Webkit browsers (Chrome, Safari) */
     .scrollable::-webkit-scrollbar {
         width: 12px;
     }

     .scrollable::-webkit-scrollbar-track {
         background: #f1f1f1;
         /* Light grey background for the track */
         border-radius: 10px;
     }

     .scrollable::-webkit-scrollbar-thumb {
         background-color: #7c3aed;
         /* Purple color for the thumb */
         border-radius: 10px;
         border: 3px solid #f1f1f1;
         /* Add padding around the thumb */
     }

     .scrollable::-webkit-scrollbar-thumb:hover {
         background-color: #5b21b6;
         /* Darker purple when hovered */
     }

     /* Firefox */
     .scrollable {
         scrollbar-width: thin;
         scrollbar-color: #7c3aed #f1f1f1;
         /* Thumb and track colors */
     }
 </style>
 <div class="begginer-wrapper py-20">
     <div class="title-container font-bold font-poppins mb-6">
         <h1 class="text-sm rounded-lg bg-primary text-third p-2 inline-block">STRUCTURE & WRITTEN EXPRESSION</h1>
     </div>
     <div class="body-container flex">
         <!-- Left Column (Reading Passage) -->
         <div class="w-full p-4">
             <div class="bg-white shadow-lg rounded-lg p-6 scrollable">
                 <h1 class="text-xl font-bold mb-4">READING</h1>
                 <p class="text-justify leading-relaxed w-[400px]">
                     <!-- Add your reading passage here -->
                     The deepest that any person can get below the surface of Earth is to the bottom of the deepest
                     mine, a <strong>mere</strong> 4 kilometers; the deepest hole ever drilled into Earth’s crust
                     reached less than 20 kilometers below the surface. Although the details of Earth’s gravitational
                     and magnetic fields give some extra information about what is going on inside Earth, for the most
                     part our understanding of Earth’s interior is still dependent
                     on the detection of <strong>seismic waves</strong>, the vibrations caused by <strong>earthquakes</strong>. These waves travel through
                     Earth and are reflected and refracted by boundaries between different layers of rock.
                     <!-- The full passage continues here --> <br> <br>
                     What the analysis of seismic waves shows is a layered structure built around a solid inner core,
                     which has a radius of about 1,600 kilometers. This inner core is surrounded
                     by a liquid outer core, which has a thickness of just over 1,800 kilometers. The whole core is very
                     dense, probably rich in iron, and has a temperature of nearly 5,000 degrees Celsius. The
                     circulation of this electrically conducting material in the liquid outer core is clearly
                     responsible for the generation of Earth’s <strong>magnetic field</strong>, but nobody has ever been able to work out
                     a <strong>thoroughly</strong> satisfactory model of how this process works.
                     <!-- The full passage continues here --> <br> <br>
                     The high temperature in the core is in part a result of the fact that the Earth formed as a ball of
                     molten rock. Once a cool crust had formed around the molten ball of rock, <strong>it functioned</strong> as an
                     insulating blanket. Even so, without some continuing injection of heat, the interior of Earth could
                     not still be as hot as it is today, more than four billion years
                     later. The extra heat comes from radioactive isotopes (originally <strong>manufactured</strong> by
                     stars), which decay into <strong>stable elements</strong> and give out energy as they do so. In about ten
                     billion years, even this source of heat will be used up, and Earth will gradually cool down.
                 </p>
             </div>
         </div>

         <!-- Right Column (Questions) -->
         <div class="w-full p-4">
             <div class="scrollable" style="width: 600px;">
                 <div class="bg-white shadow-lg rounded-lg p-6 w-[800px]">
                     <h2 class="text-xl font-bold mb-4">Questions 11-22</h2>

                     <!-- Question 11 -->
                     <div class="mb-6">
                         <p class="text-md">11. What does the passage mainly discuss? </p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[11]" value="A"
                                         class="mr-2">
                                     (A) The similarities between Earth’s inner core and outer core
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[11]" value="B"
                                         class="mr-2"> (B) The structure and temperature of Earth’s interior
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[11]" value="C"
                                         class="mr-2"> (C) When seismic waves were first used to study Earth’s
                                     interior
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[11]" value="D"
                                         class="mr-2"> (D) Why Earth’s solid inner core is surrounded by a molten
                                     outer core
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 12 -->
                     <div class="mb-6">
                         <p class="text-md">12. The word “mere” is closest in meaning to </p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[12]" value="A"
                                         class="mr-2"> (A) approximate
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[12]" value="B"
                                         class="mr-2"> (B) insignificant
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[12]" value="C"
                                         class="mr-2"> (C) measured
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[12]" value="D"
                                         class="mr-2"> (D) lengthy</label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 13 -->
                     <div class="mb-6">
                         <p class="text-md">13. According to the first paragraph, most knowledge of Earth’s interior has
                             been gained by studying</p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[13]" value="A"
                                         class="mr-2"> (A) Earth’s gravitational field</label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[13]" value="B"
                                         class="mr-2"> (B) Earth’s magnetic field
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[13]" value="C"
                                         class="mr-2"> (C) vibrations caused by earthquakes
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[13]" value="D"
                                         class="mr-2"> (D) material taken from holes drilled into Earth’s crust
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 14 -->
                     <div class="mb-6">
                         <p class="text-md">14. According to the second paragraph, which of the following statements
                             regarding Earth’s inner core and outer core is true?</p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[14]" value="A"
                                         class="mr-2"> (A) Neither the inner core nor the outer core can be studied
                                     using seismic waves.
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[14]" value="B"
                                         class="mr-2"> (B) The outer core is more solid than the inner core.
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[14]" value="C"
                                         class="mr-2"> (C) The inner core and the outer core have greatly different
                                     temperatures.
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[14]" value="D"
                                         class="mr-2"> (D) Both the inner core and the outer core probably contain
                                     iron.
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 15 -->
                     <div class="mb-6">
                         <p class="text-md">15. The word “thoroughly” is closest in meaning to</p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[15]" value="A"
                                         class="mr-2"> (A) basically
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[15]" value="B"
                                         class="mr-2"> (B) similarly </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[15]" value="C"
                                         class="mr-2"> (C) potentially
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[15]" value="D"
                                         class="mr-2"> (D) completely
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 16 -->
                     <div class="mb-6">
                         <p class="text-md">16. The word “it” in the 3rd paragraph on line 4 refers to </p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[16]" value="A"
                                         class="mr-2"> (A) Earth
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[16]" value="B"
                                         class="mr-2"> (B) a cool crust
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[16]" value="C"
                                         class="mr-2"> (C) the molten ball of rock
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[16]" value="D"
                                         class="mr-2"> (D) the heat
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 17 -->
                     <div class="mb-6">
                         <p class="text-md">17. The word “functioned” in the 3rd paragraph on line 4 is closest in meaning to</p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[17]" value="A"
                                         class="mr-2"> (A) acted
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[17]" value="B"
                                         class="mr-2"> (B) moved
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[17]" value="C"
                                         class="mr-2"> (C) appeared
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[17]" value="D"
                                         class="mr-2"> (D) grew
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 18 -->
                     <div class="mb-6">
                         <p class="text-md">18. The word “manufactured” in the 3rd paragraph on line 9 is closest in meaning to </p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[18]" value="A"
                                         class="mr-2"> (A) changed
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[18]" value="B"
                                         class="mr-2"> (B) combined
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[18]" value="C"
                                         class="mr-2"> (C) utilized
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[18]" value="D"
                                         class="mr-2"> (D) made
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 19 -->
                     <div class="mb-6">
                         <p class="text-md">19. The third paragraph mentions which of the following as one cause of the
                             current high temperature of Earth’s interior? </p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[19]" value="A"
                                         class="mr-2"> (A) The decay of radioactive isotopes
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[19]" value="B"
                                         class="mr-2"> (B) The movement of elements from Earth’s crust to its
                                     interior
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[19]" value="C"
                                         class="mr-2"> (C) The vibrations that result from movement of Earth’s crust
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[19]" value="D"
                                         class="mr-2"> (D) The injection of certain organic elements into Earth’s
                                     inner core
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 20 -->
                     <div class="mb-6">
                         <p class="text-md">20. Look at the terms“seismic waves” (1st paragraph),“earthquakes” (1st paragraph),
                             “magnetic field” (2nd paragraph), and “stable elements” (3rd paragraph). Which of these terms is
                             defined in the passage?
                         </p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[20]" value="A"
                                         class="mr-2"> (A) seismic waves
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[20]" value="B"
                                         class="mr-2"> (B) earthquakes
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[20]" value="C"
                                         class="mr-2"> (C) magnetic field
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[20]" value="D"
                                         class="mr-2"> (D) stable elements
                                 </label>
                             </li>
                         </ul>
                     </div>

                     <!-- Question 21 -->
                     <div class="mb-6">
                         <p class="text-md">21. According to the passage, scientists do not understand in detail how
                         </p>
                         <ul class="space-y-2 mt-4 text-sm">
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[21]" value="A"
                                         class="mr-2"> (A) the crust affects Earth’s internal temperature
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[21]" value="B"
                                         class="mr-2"> (B) radioactive isotopes cause heat
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[21]" value="C"
                                         class="mr-2"> (C) Earth’s magnetic field is created
                                 </label>
                             </li>
                             <li>
                                 <label>
                                     <input type="radio" required name="exam2section3question[21]" value="D"
                                         class="mr-2"> (D) seismic waves originate
                                 </label>
                             </li>
                         </ul>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </div>
