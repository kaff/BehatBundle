Feature: Set up basic URIElement SiteAccess matching configuration

  @admin
  Scenario: Add a language. Create a siteaccess using it and add it to PageBuilder
    Given Language "Polski" with code "pol-PL" exists
    And I add a siteaccess "test" to "site_group" with settings
      | key       | value  |
      | languages | pol-PL,eng-GB |
    And I "set" siteaccess matcher configuration
    """
    URIElement:
        1
    """
    And I append configuration to "admin_group" siteaccess
      | key                          | value  |
      | languages                    | pol-PL |
      | page_builder.siteaccess_list | test   |
