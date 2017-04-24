
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:ElasticSearchClient" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="ElasticSearchClient.html">ElasticSearchClient</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:ElasticSearchClient_ElasticSearchClient" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="ElasticSearchClient/ElasticSearchClient.html">ElasticSearchClient</a>                    </div>                </li>                            <li data-name="class:ElasticSearchClient_Mapping" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="ElasticSearchClient/Mapping.html">Mapping</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:MySQLWithElasticsearchExceptions" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="MySQLWithElasticsearchExceptions.html">MySQLWithElasticsearchExceptions</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:MySQLWithElasticsearchExceptions_SearchException" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="MySQLWithElasticsearchExceptions/SearchException.html">SearchException</a>                    </div>                </li>                            <li data-name="class:MySQLWithElasticsearchExceptions_SyncMySqlExceptions" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="MySQLWithElasticsearchExceptions/SyncMySqlExceptions.html">SyncMySqlExceptions</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:SearchElastic" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="SearchElastic.html">SearchElastic</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:SearchElastic_SearchAbstract" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="SearchElastic/SearchAbstract.html">SearchAbstract</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:SearchElastic_SearchAbstract_SearchAbstract" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SearchElastic/SearchAbstract/SearchAbstract.html">SearchAbstract</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:SearchElastic_Search" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="SearchElastic/Search.html">Search</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:SyncMySql" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="SyncMySql.html">SyncMySql</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:SyncMySql_Connection" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="SyncMySql/Connection.html">Connection</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:SyncMySql_Connection_Connection" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SyncMySql/Connection/Connection.html">Connection</a>                    </div>                </li>                            <li data-name="class:SyncMySql_Connection_MySQLiConnection" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SyncMySql/Connection/MySQLiConnection.html">MySQLiConnection</a>                    </div>                </li>                            <li data-name="class:SyncMySql_Connection_PDOConnection" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SyncMySql/Connection/PDOConnection.html">PDOConnection</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:SyncMySql_SyncMySql" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="SyncMySql/SyncMySql.html">SyncMySql</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "ElasticSearchClient.html", "name": "ElasticSearchClient", "doc": "Namespace ElasticSearchClient"},{"type": "Namespace", "link": "MySQLWithElasticsearchExceptions.html", "name": "MySQLWithElasticsearchExceptions", "doc": "Namespace MySQLWithElasticsearchExceptions"},{"type": "Namespace", "link": "SearchElastic.html", "name": "SearchElastic", "doc": "Namespace SearchElastic"},{"type": "Namespace", "link": "SearchElastic/SearchAbstract.html", "name": "SearchElastic\\SearchAbstract", "doc": "Namespace SearchElastic\\SearchAbstract"},{"type": "Namespace", "link": "SyncMySql.html", "name": "SyncMySql", "doc": "Namespace SyncMySql"},{"type": "Namespace", "link": "SyncMySql/Connection.html", "name": "SyncMySql\\Connection", "doc": "Namespace SyncMySql\\Connection"},
            {"type": "Interface", "fromName": "SyncMySql\\Connection", "fromLink": "SyncMySql/Connection.html", "link": "SyncMySql/Connection/Connection.html", "name": "SyncMySql\\Connection\\Connection", "doc": "&quot;An Interface for database connection classes&quot;"},
                                                        {"type": "Method", "fromName": "SyncMySql\\Connection\\Connection", "fromLink": "SyncMySql/Connection/Connection.html", "link": "SyncMySql/Connection/Connection.html#method_getData", "name": "SyncMySql\\Connection\\Connection::getData", "doc": "&quot;Get Data From Elasticsearch&quot;"},
            
            
            {"type": "Class", "fromName": "ElasticSearchClient", "fromLink": "ElasticSearchClient.html", "link": "ElasticSearchClient/ElasticSearchClient.html", "name": "ElasticSearchClient\\ElasticSearchClient", "doc": "&quot;Class to get Elasticsearch connection. Also used to set and get \&quot;index\&quot;\nand \&quot;type\&quot; in Elasticsearch&quot;"},
                                                        {"type": "Method", "fromName": "ElasticSearchClient\\ElasticSearchClient", "fromLink": "ElasticSearchClient/ElasticSearchClient.html", "link": "ElasticSearchClient/ElasticSearchClient.html#method_setIndex", "name": "ElasticSearchClient\\ElasticSearchClient::setIndex", "doc": "&quot;Set Index to Use in Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "ElasticSearchClient\\ElasticSearchClient", "fromLink": "ElasticSearchClient/ElasticSearchClient.html", "link": "ElasticSearchClient/ElasticSearchClient.html#method_setType", "name": "ElasticSearchClient\\ElasticSearchClient::setType", "doc": "&quot;Set Type to use in Elasticsearch&quot;"},
                    {"type": "Method", "fromName": "ElasticSearchClient\\ElasticSearchClient", "fromLink": "ElasticSearchClient/ElasticSearchClient.html", "link": "ElasticSearchClient/ElasticSearchClient.html#method_getIndex", "name": "ElasticSearchClient\\ElasticSearchClient::getIndex", "doc": "&quot;Get Index to use in Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "ElasticSearchClient\\ElasticSearchClient", "fromLink": "ElasticSearchClient/ElasticSearchClient.html", "link": "ElasticSearchClient/ElasticSearchClient.html#method_getType", "name": "ElasticSearchClient\\ElasticSearchClient::getType", "doc": "&quot;Get Type to use in Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "ElasticSearchClient\\ElasticSearchClient", "fromLink": "ElasticSearchClient/ElasticSearchClient.html", "link": "ElasticSearchClient/ElasticSearchClient.html#method_getClient", "name": "ElasticSearchClient\\ElasticSearchClient::getClient", "doc": "&quot;Get Elasticsearch Client.&quot;"},
            
            {"type": "Class", "fromName": "ElasticSearchClient", "fromLink": "ElasticSearchClient.html", "link": "ElasticSearchClient/Mapping.html", "name": "ElasticSearchClient\\Mapping", "doc": "&quot;Class to create Maps on Elasticsearch&quot;"},
                                                        {"type": "Method", "fromName": "ElasticSearchClient\\Mapping", "fromLink": "ElasticSearchClient/Mapping.html", "link": "ElasticSearchClient/Mapping.html#method___construct", "name": "ElasticSearchClient\\Mapping::__construct", "doc": "&quot;Creating $client for Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "ElasticSearchClient\\Mapping", "fromLink": "ElasticSearchClient/Mapping.html", "link": "ElasticSearchClient/Mapping.html#method_createMapping", "name": "ElasticSearchClient\\Mapping::createMapping", "doc": "&quot;Create mapping for Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "ElasticSearchClient\\Mapping", "fromLink": "ElasticSearchClient/Mapping.html", "link": "ElasticSearchClient/Mapping.html#method_deleteMapping", "name": "ElasticSearchClient\\Mapping::deleteMapping", "doc": "&quot;Delete the previous mapping by passing its name&quot;"},
            
            {"type": "Class", "fromName": "MySQLWithElasticsearchExceptions", "fromLink": "MySQLWithElasticsearchExceptions.html", "link": "MySQLWithElasticsearchExceptions/SearchException.html", "name": "MySQLWithElasticsearchExceptions\\SearchException", "doc": "&quot;Handle exception thrown by Search Elastic&quot;"},
                                                        {"type": "Method", "fromName": "MySQLWithElasticsearchExceptions\\SearchException", "fromLink": "MySQLWithElasticsearchExceptions/SearchException.html", "link": "MySQLWithElasticsearchExceptions/SearchException.html#method___construct", "name": "MySQLWithElasticsearchExceptions\\SearchException::__construct", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "MySQLWithElasticsearchExceptions", "fromLink": "MySQLWithElasticsearchExceptions.html", "link": "MySQLWithElasticsearchExceptions/SyncMySqlExceptions.html", "name": "MySQLWithElasticsearchExceptions\\SyncMySqlExceptions", "doc": "&quot;Handle Exception thrown by SynMySql class&quot;"},
                                                        {"type": "Method", "fromName": "MySQLWithElasticsearchExceptions\\SyncMySqlExceptions", "fromLink": "MySQLWithElasticsearchExceptions/SyncMySqlExceptions.html", "link": "MySQLWithElasticsearchExceptions/SyncMySqlExceptions.html#method___construct", "name": "MySQLWithElasticsearchExceptions\\SyncMySqlExceptions::__construct", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "SearchElastic", "fromLink": "SearchElastic.html", "link": "SearchElastic/Search.html", "name": "SearchElastic\\Search", "doc": "&quot;Class to perform basic search extends from SearchElastic\\SearchAbstract\\SearchAbstract&quot;"},
                                                        {"type": "Method", "fromName": "SearchElastic\\Search", "fromLink": "SearchElastic/Search.html", "link": "SearchElastic/Search.html#method_search", "name": "SearchElastic\\Search::search", "doc": "&quot;Abstract function to be implement for search&quot;"},
            
            {"type": "Class", "fromName": "SearchElastic\\SearchAbstract", "fromLink": "SearchElastic/SearchAbstract.html", "link": "SearchElastic/SearchAbstract/SearchAbstract.html", "name": "SearchElastic\\SearchAbstract\\SearchAbstract", "doc": "&quot;An abstract class for searching in Elasticsearch having an abstract search()&quot;"},
                                                        {"type": "Method", "fromName": "SearchElastic\\SearchAbstract\\SearchAbstract", "fromLink": "SearchElastic/SearchAbstract/SearchAbstract.html", "link": "SearchElastic/SearchAbstract/SearchAbstract.html#method___construct", "name": "SearchElastic\\SearchAbstract\\SearchAbstract::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "SearchElastic\\SearchAbstract\\SearchAbstract", "fromLink": "SearchElastic/SearchAbstract/SearchAbstract.html", "link": "SearchElastic/SearchAbstract/SearchAbstract.html#method_setIndex", "name": "SearchElastic\\SearchAbstract\\SearchAbstract::setIndex", "doc": "&quot;Set Index to Use in Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "SearchElastic\\SearchAbstract\\SearchAbstract", "fromLink": "SearchElastic/SearchAbstract/SearchAbstract.html", "link": "SearchElastic/SearchAbstract/SearchAbstract.html#method_setType", "name": "SearchElastic\\SearchAbstract\\SearchAbstract::setType", "doc": "&quot;Set Type to use in Elasticsearch&quot;"},
                    {"type": "Method", "fromName": "SearchElastic\\SearchAbstract\\SearchAbstract", "fromLink": "SearchElastic/SearchAbstract/SearchAbstract.html", "link": "SearchElastic/SearchAbstract/SearchAbstract.html#method_setSearchColumn", "name": "SearchElastic\\SearchAbstract\\SearchAbstract::setSearchColumn", "doc": "&quot;Set Search Column to use for search in Elasticsearch&quot;"},
                    {"type": "Method", "fromName": "SearchElastic\\SearchAbstract\\SearchAbstract", "fromLink": "SearchElastic/SearchAbstract/SearchAbstract.html", "link": "SearchElastic/SearchAbstract/SearchAbstract.html#method_extractResult", "name": "SearchElastic\\SearchAbstract\\SearchAbstract::extractResult", "doc": "&quot;Function to extract Search Result From ElasticSearch&quot;"},
                    {"type": "Method", "fromName": "SearchElastic\\SearchAbstract\\SearchAbstract", "fromLink": "SearchElastic/SearchAbstract/SearchAbstract.html", "link": "SearchElastic/SearchAbstract/SearchAbstract.html#method_validate", "name": "SearchElastic\\SearchAbstract\\SearchAbstract::validate", "doc": "&quot;Function to validate Search&quot;"},
                    {"type": "Method", "fromName": "SearchElastic\\SearchAbstract\\SearchAbstract", "fromLink": "SearchElastic/SearchAbstract/SearchAbstract.html", "link": "SearchElastic/SearchAbstract/SearchAbstract.html#method_search", "name": "SearchElastic\\SearchAbstract\\SearchAbstract::search", "doc": "&quot;Abstract function to be implement for search&quot;"},
            
            {"type": "Class", "fromName": "SyncMySql\\Connection", "fromLink": "SyncMySql/Connection.html", "link": "SyncMySql/Connection/Connection.html", "name": "SyncMySql\\Connection\\Connection", "doc": "&quot;An Interface for database connection classes&quot;"},
                                                        {"type": "Method", "fromName": "SyncMySql\\Connection\\Connection", "fromLink": "SyncMySql/Connection/Connection.html", "link": "SyncMySql/Connection/Connection.html#method_getData", "name": "SyncMySql\\Connection\\Connection::getData", "doc": "&quot;Get Data From Elasticsearch&quot;"},
            
            {"type": "Class", "fromName": "SyncMySql\\Connection", "fromLink": "SyncMySql/Connection.html", "link": "SyncMySql/Connection/MySQLiConnection.html", "name": "SyncMySql\\Connection\\MySQLiConnection", "doc": "&quot;Class to handle MySqli Object Oriented connection&quot;"},
                                                        {"type": "Method", "fromName": "SyncMySql\\Connection\\MySQLiConnection", "fromLink": "SyncMySql/Connection/MySQLiConnection.html", "link": "SyncMySql/Connection/MySQLiConnection.html#method_getData", "name": "SyncMySql\\Connection\\MySQLiConnection::getData", "doc": "&quot;Get Data From Elasticsearch&quot;"},
            
            {"type": "Class", "fromName": "SyncMySql\\Connection", "fromLink": "SyncMySql/Connection.html", "link": "SyncMySql/Connection/PDOConnection.html", "name": "SyncMySql\\Connection\\PDOConnection", "doc": "&quot;Class to handle PDO connection&quot;"},
                                                        {"type": "Method", "fromName": "SyncMySql\\Connection\\PDOConnection", "fromLink": "SyncMySql/Connection/PDOConnection.html", "link": "SyncMySql/Connection/PDOConnection.html#method_getData", "name": "SyncMySql\\Connection\\PDOConnection::getData", "doc": "&quot;Get Data From Elasticsearch&quot;"},
            
            {"type": "Class", "fromName": "SyncMySql", "fromLink": "SyncMySql.html", "link": "SyncMySql/SyncMySql.html", "name": "SyncMySql\\SyncMySql", "doc": "&quot;Class to Sync MySQL Database&quot;"},
                                                        {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method___construct", "name": "SyncMySql\\SyncMySql::__construct", "doc": "&quot;Constructor&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_setConnection", "name": "SyncMySql\\SyncMySql::setConnection", "doc": "&quot;Set Database Connection.&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_setIndex", "name": "SyncMySql\\SyncMySql::setIndex", "doc": "&quot;Set Index to Use in Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_setType", "name": "SyncMySql\\SyncMySql::setType", "doc": "&quot;Set Type to use in Elasticsearch&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_setIdColumn", "name": "SyncMySql\\SyncMySql::setIdColumn", "doc": "&quot;Set Id column which will be set as ID in Elasticsearch index&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_setSqlQuery", "name": "SyncMySql\\SyncMySql::setSqlQuery", "doc": "&quot;Set sqlQuery to get data from database&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_insertAllData", "name": "SyncMySql\\SyncMySql::insertAllData", "doc": "&quot;Sync All data of MySQL in Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_insertNode", "name": "SyncMySql\\SyncMySql::insertNode", "doc": "&quot;Insert single data in Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_updateNode", "name": "SyncMySql\\SyncMySql::updateNode", "doc": "&quot;Update single data in Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_deleteNode", "name": "SyncMySql\\SyncMySql::deleteNode", "doc": "&quot;Delete single data from Elasticsearch.&quot;"},
                    {"type": "Method", "fromName": "SyncMySql\\SyncMySql", "fromLink": "SyncMySql/SyncMySql.html", "link": "SyncMySql/SyncMySql.html#method_validate", "name": "SyncMySql\\SyncMySql::validate", "doc": "&quot;Validation of $data.&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


