// Location API Fallback Script
// This script provides fallback functionality for loading states and cities

(function() {
    'use strict';
    
    // Configuration
    const CONFIG = {
        endpoints: {
            states: [
                '{{ url("api/states") }}/',
                '/api/states/',
                '{{ url("public/states") }}/',
                '/public/states/'
            ],
            cities: [
                '{{ url("api/cities") }}/',
                '/api/cities/',
                '{{ url("public/cities") }}/',
                '/public/cities/'
            ]
        },
        timeout: 10000
    };
    
    // Utility function to make AJAX requests with fallback
    function makeRequestWithFallback(endpoints, successCallback, errorCallback) {
        let currentEndpoint = 0;
        
        function tryNextEndpoint() {
            if (currentEndpoint >= endpoints.length) {
                if (errorCallback) errorCallback();
                return;
            }
            
            const url = endpoints[currentEndpoint];
            
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                timeout: CONFIG.timeout,
                success: function(data) {
                    if (Array.isArray(data) && data.length > 0) {
                        if (successCallback) successCallback(data);
                    } else {
                        currentEndpoint++;
                        tryNextEndpoint();
                    }
                },
                error: function() {
                    currentEndpoint++;
                    tryNextEndpoint();
                }
            });
        }
        
        tryNextEndpoint();
    }
    
    // Load states for a country
    window.loadStatesForCountry = function(countryId, stateSelectId, citySelectId) {
        const stateSelect = $('#' + stateSelectId);
        const citySelect = $('#' + citySelectId);
        
        // Reset dropdowns
        stateSelect.html('<option value="">Select State</option>').prop('disabled', true);
        if (citySelect.length) {
            citySelect.html('<option value="">Select City</option>').prop('disabled', true);
        }
        
        if (!countryId) return;
        
        const endpoints = CONFIG.endpoints.states.map(endpoint => endpoint + countryId);
        
        makeRequestWithFallback(
            endpoints,
            function(data) {
                $.each(data, function(key, value) {
                    stateSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                stateSelect.prop('disabled', false);
            },
            function() {
                alert('Error loading states. Please try again.');
            }
        );
    };
    
    // Load cities for a state
    window.loadCitiesForState = function(stateId, citySelectId) {
        const citySelect = $('#' + citySelectId);
        
        // Reset city dropdown
        citySelect.html('<option value="">Select City</option>').prop('disabled', true);
        
        if (!stateId) return;
        
        const endpoints = CONFIG.endpoints.cities.map(endpoint => endpoint + stateId);
        
        makeRequestWithFallback(
            endpoints,
            function(data) {
                $.each(data, function(key, value) {
                    citySelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                citySelect.prop('disabled', false);
            },
            function() {
                alert('Error loading cities. Please try again.');
            }
        );
    };
    
    // Initialize when document is ready
    $(document).ready(function() {
        // Override existing country change handlers
        $('#country, #ship_country').off('change').on('change', function() {
            const countryId = $(this).val();
            const isShipping = $(this).attr('id') === 'ship_country';
            const stateId = isShipping ? 'ship_state' : 'state';
            const cityId = isShipping ? 'ship_city' : 'city';
            
            loadStatesForCountry(countryId, stateId, cityId);
        });
        
        // Override existing state change handlers
        $('#state, #ship_state').off('change').on('change', function() {
            const stateId = $(this).val();
            const isShipping = $(this).attr('id') === 'ship_state';
            const cityId = isShipping ? 'ship_city' : 'city';
            
            loadCitiesForState(stateId, cityId);
        });
    });
    
})();
