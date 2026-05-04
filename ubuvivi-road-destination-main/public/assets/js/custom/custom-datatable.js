/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/custom/custom-datatable.js":
/*!********************************************************!*\
  !*** ./resources/assets/js/custom/custom-datatable.js ***!
  \********************************************************/
/***/ (() => {

eval("\n\n$.extend($.fn.dataTable.defaults, {\n  'paging': true,\n  'info': true,\n  'ordering': true,\n  'autoWidth': false,\n  'pageLength': 10,\n  'language': {\n    'search': '',\n    'sSearch': 'Search'\n  },\n  \"preDrawCallback\": function preDrawCallback() {\n    customSearch();\n  }\n});\nfunction customSearch() {\n  $('.dataTables_filter input').addClass(\"form-control\");\n  $('.dataTables_filter input').attr(\"placeholder\", \"Search\");\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2N1c3RvbS9jdXN0b20tZGF0YXRhYmxlLmpzLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViQSxDQUFDLENBQUNDLE1BQU0sQ0FBQ0QsQ0FBQyxDQUFDRSxFQUFFLENBQUNDLFNBQVMsQ0FBQ0MsUUFBUSxFQUFFO0VBQzlCLFFBQVEsRUFBRSxJQUFJO0VBQ2QsTUFBTSxFQUFFLElBQUk7RUFDWixVQUFVLEVBQUUsSUFBSTtFQUNoQixXQUFXLEVBQUUsS0FBSztFQUNsQixZQUFZLEVBQUUsRUFBRTtFQUNoQixVQUFVLEVBQUU7SUFDUixRQUFRLEVBQUUsRUFBRTtJQUNaLFNBQVMsRUFBRTtFQUNmLENBQUM7RUFDRCxpQkFBaUIsRUFBRSxTQUFBQyxnQkFBQSxFQUFZO0lBQzNCQyxZQUFZLENBQUMsQ0FBQztFQUNsQjtBQUNKLENBQUMsQ0FBQztBQUVGLFNBQVNBLFlBQVlBLENBQUEsRUFBRztFQUNwQk4sQ0FBQyxDQUFDLDBCQUEwQixDQUFDLENBQUNPLFFBQVEsQ0FBQyxjQUFjLENBQUM7RUFDdERQLENBQUMsQ0FBQywwQkFBMEIsQ0FBQyxDQUFDUSxJQUFJLENBQUMsYUFBYSxFQUFFLFFBQVEsQ0FBQztBQUMvRCIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvanMvY3VzdG9tL2N1c3RvbS1kYXRhdGFibGUuanM/OWM1OCJdLCJzb3VyY2VzQ29udGVudCI6WyIndXNlIHN0cmljdCc7XG5cbiQuZXh0ZW5kKCQuZm4uZGF0YVRhYmxlLmRlZmF1bHRzLCB7XG4gICAgJ3BhZ2luZyc6IHRydWUsXG4gICAgJ2luZm8nOiB0cnVlLFxuICAgICdvcmRlcmluZyc6IHRydWUsXG4gICAgJ2F1dG9XaWR0aCc6IGZhbHNlLFxuICAgICdwYWdlTGVuZ3RoJzogMTAsXG4gICAgJ2xhbmd1YWdlJzoge1xuICAgICAgICAnc2VhcmNoJzogJycsXG4gICAgICAgICdzU2VhcmNoJzogJ1NlYXJjaCcsXG4gICAgfSxcbiAgICBcInByZURyYXdDYWxsYmFja1wiOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGN1c3RvbVNlYXJjaCgpXG4gICAgfVxufSk7XG5cbmZ1bmN0aW9uIGN1c3RvbVNlYXJjaCgpIHtcbiAgICAkKCcuZGF0YVRhYmxlc19maWx0ZXIgaW5wdXQnKS5hZGRDbGFzcyhcImZvcm0tY29udHJvbFwiKTtcbiAgICAkKCcuZGF0YVRhYmxlc19maWx0ZXIgaW5wdXQnKS5hdHRyKFwicGxhY2Vob2xkZXJcIiwgXCJTZWFyY2hcIik7XG59XG4iXSwibmFtZXMiOlsiJCIsImV4dGVuZCIsImZuIiwiZGF0YVRhYmxlIiwiZGVmYXVsdHMiLCJwcmVEcmF3Q2FsbGJhY2siLCJjdXN0b21TZWFyY2giLCJhZGRDbGFzcyIsImF0dHIiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/js/custom/custom-datatable.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/js/custom/custom-datatable.js"]();
/******/ 	
/******/ })()
;